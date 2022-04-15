<?php

namespace App\Models\Activations;


use App\Models\User;
use App\Traits\RepositoryTrait;
use Carbon\Carbon;

class IlluminateActivationRepository implements ActivationRepositoryInterface{
    use RepositoryTrait;
    /**
     * The Eloquent activation model name.
     *
     * @var string
     */
    protected $model = EloquentActivation::class;

    /**
     * The activation expiration time, in seconds.
     *
     * @var int
     */
    protected $expires = 259200;

    /**
     * Create a new Illuminate activation repository.
     *
     * @param  string $model
     * @param  int $expires
     */
    public function __construct($model = null, $expires = null)
    {
        if (isset($model)) {
            $this->model = $model;
        }

        if (isset($expires)) {
            $this->expires = $expires;
        }
    }

    /**
     * {@inheritDoc}
     */
    public function create(User $user)
    {
        $activation = $this->createModel();

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
            ->createModel()
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
         * @var EloquentActivation $activation
         */
        $activation = $this
            ->createModel()
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
            'completed' => true,
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
            ->createModel()
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
         * @var EloquentActivation $activation
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
            ->createModel()
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
        return str_random(32);
    }
}
