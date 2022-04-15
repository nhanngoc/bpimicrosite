<?php

namespace App\Repositories\CargoType\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface CargoTypeInterface extends RepositoryInterface
{
/**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
    /**
     * GetList For Select ['id' => 'value]
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getIdList($prependList = array(), $appendList = array());
}

