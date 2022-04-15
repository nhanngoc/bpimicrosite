<?php

namespace App\Repositories\UOM\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface UOMInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}
