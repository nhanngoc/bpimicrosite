<?php

namespace App\Repositories\PortCode\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface PortCodeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}
