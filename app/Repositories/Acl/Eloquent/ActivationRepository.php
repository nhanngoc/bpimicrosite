<?php

namespace App\Repositories\Acl\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Models\User;
use App\Repositories\Acl\Interfaces\ActivationInterface;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;

class ActivationRepository extends RepositoriesAbstract implements ActivationInterface
{
    /**
     * The activation expiration time, in seconds.
     *
     * @var int
     */
    protected $expires = 259200;

    /**
     * {@inheritDoc}
     */
    public function createUser(User $user)
    {
        $activation = $this->model;

        $code = $this->generateActivationCode();

        $activation->fill(compact('code'));

        $activation->user_id = $user->getKey();

        $activation->save();

        return $activation;
    }

    /**
     * {@inheritDoc}
     */
    public function exists(User $user, $code = null)
    {
        $expires = $this->expires();

        /**
         * @var Builder $activation
         */
        $activation = $this
            ->model
            ->newQuery()
            ->where('user_id', $user->getKey())
            ->where('completed', false)
            ->where('created_at', '>', $expires);

        if ($code) {
            $activation->where('code', $code);
        }

        return $activation->first() ?: false;
    }

    /**
     * {@inheritDoc}
     */
    public function complete(User $user, $code)
    {
        $expires = $this->expires();

        /**
         * @var Activation $activation
         */
        $activation = $this
            ->model
            ->newQuery()
            ->where('user_id', $user->getKey())
            ->where('code', $code)
            ->where('completed', false)
            ->where('created_at', '>', $expires)
            ->first();

        if ($activation === null) {
            return false;
        }

        $activation->fill([
            'completed'    => true,
            'completed_at' => Carbon::now(config('app.timezone')),
        ]);

        $activation->save();

        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function completed(User $user)
    {
        $activation = $this
            ->model
            ->newQuery()
            ->where('user_id', $user->getKey())
            ->where('completed', true)
            ->first();

        return $activation ?: false;
    }

    /**
     * {@inheritDoc}
     * @throws \Exception
     */
    public function remove(User $user)
    {
        /**
         * @var Activation $activation
         */
        $activation = $this->completed($user);

        if ($activation === false) {
            return false;
        }

        return $activation->delete();
    }

    /**
     * {@inheritDoc}
     */
    public function removeExpired()
    {
        $expires = $this->expires();

        return $this
            ->model
            ->newQuery()
            ->where('completed', false)
            ->where('created_at', '<', $expires)
            ->delete();
    }

    /**
     * Returns the expiration date.
     *
     * @return \Carbon\Carbon
     */
    protected function expires()
    {
        return Carbon::now(config('app.timezone'))->subSeconds($this->expires);
    }

    /**
     * Return a random string for an activation code.
     *
     * @return string
     */
    protected function generateActivationCode()
    {
        return Str::random(32);
    }
}
