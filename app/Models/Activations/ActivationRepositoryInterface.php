<?php

namespace App\Models\Activations;

use App\Models\User;

interface ActivationRepositoryInterface
{
    /**
     * Create a new activation record and code.
     * @param User $user
     * @return mixed
     */
    public function create(User $user);

    /**
     * Checks if a valid activation for the given user exists.
     * @param User $user
     * @param null $code
     * @return mixed
     */
    public function exists(User $user, $code = null);

    /**
     * Completes the activation for the given user.
     * @param User $user
     * @param $code
     * @return mixed
     */
    public function complete(User $user, $code);

    /**
     * Checks if a valid activation has been completed.
     *
     * @param User $user
     * @return mixed
     */
    public function completed(User $user);

    /**
     * Remove an existing activation (deactivate).
     * @param User $user
     * @return mixed
     */
    public function remove(User $user);

    /**
     * Remove expired activation codes.
     *
     * @return int
     */
    public function removeExpired();
}
