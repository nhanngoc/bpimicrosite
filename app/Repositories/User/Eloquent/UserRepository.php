<?php

namespace App\Repositories\User\Eloquent;

use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\User\Interfaces\UserInterface;

class UserRepository extends RepositoriesAbstract implements UserInterface
{
    /**
     * {@inheritdoc}
     */
    public function getUniqueUsernameFromEmail($email)
    {
        $emailPrefix = substr($email, 0, strpos($email, '@'));
        $username = $emailPrefix;
        $offset = 1;
        while ($this->getFirstBy(['username' => $username])) {
            $username = $emailPrefix . $offset;
            $offset++;
        }

        $this->resetModel();

        return $username;
    }
}
