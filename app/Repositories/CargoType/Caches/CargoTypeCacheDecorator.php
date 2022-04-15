<?php

namespace App\Repositories\CargoType\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\CargoType\Interfaces\CargoTypeInterface;

class CargoTypeCacheDecorator extends CacheAbstractDecorator implements CargoTypeInterface
{
/**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
    /**
     * GetList For Select ['id' => 'value]
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getIdList($prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
