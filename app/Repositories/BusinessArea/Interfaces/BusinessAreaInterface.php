<?php

namespace App\Repositories\BusinessArea\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface BusinessAreaInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}
