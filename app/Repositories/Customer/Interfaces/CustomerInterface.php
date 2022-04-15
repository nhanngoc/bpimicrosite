<?php

namespace App\Repositories\Customer\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface CustomerInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}
