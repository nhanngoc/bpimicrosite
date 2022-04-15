<?php

namespace App\Models;

use App\Repositories\Acl\Interfaces\ActivationInterface;
use App\Repositories\Acl\Interfaces\RoleInterface;
use App\Repositories\Acl\Interfaces\UserInterface;
use InvalidArgumentException;

class AclManager
{
    /**
     * @var UserInterface
     */
    protected $users;

    /**
     * @var RoleInterface
     */
    protected $roles;

    /**
     * @var ActivationInterface
     */
    protected $activations;

    /**
     * AclManager constructor.
     *
     * @param UserInterface $users
     * @param RoleInterface $roles
     * @param ActivationInterface $activations
     */
    public function __construct(
        UserInterface $users,
        RoleInterface $roles,
        ActivationInterface $activations
    )
    {
        $this->users = $users;

        $this->roles = $roles;

        $this->activations = $activations;
    }

    /**
     * Activates the given user.
     *
     * @param mixed $user
     * @return bool
     * @throws \InvalidArgumentException
     */
    public function activate($user)
    {
        if (!$user instanceof User) {
            throw new InvalidArgumentException('No valid user was provided.');
        }

        event('acl.activating', $user);

        $activations = $this->getActivationRepository();

        $activation = $activations->createUser($user);

        event('acl.activated', [$user, $activation]);

        return $activations->complete($user, $activation->getCode());
    }

    /**
     * @return UserInterface
     */
    public function getUserRepository()
    {
        return $this->users;
    }

    /**
     * @return RoleInterface
     */
    public function getRoleRepository()
    {
        return $this->roles;
    }

    /**
     * @param RoleInterface $roles
     */
    public function setRoleRepository(RoleInterface $roles)
    {
        $this->roles = $roles;
    }

    /**
     * @return ActivationInterface
     */
    public function getActivationRepository()
    {
        return $this->activations;
    }

    /**
     * @param ActivationInterface $activations
     */
    public function setActivationRepository(ActivationInterface $activations)
    {
        $this->activations = $activations;
    }
}
