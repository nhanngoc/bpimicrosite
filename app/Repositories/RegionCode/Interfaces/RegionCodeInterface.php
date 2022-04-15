<?php

namespace App\Repositories\RegionCode\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface RegionCodeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}

