<?php

namespace App\Repositories\Acl\Interfaces;


use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface UserInterface extends RepositoryInterface
{
    /**
     * @return mixed
     */
    public function getUsersList();
    /**
     * Get unique username from email
     *
     * @param $email
     * @return string
     *
     */
    public function getUniqueUsernameFromEmail($email);
}
