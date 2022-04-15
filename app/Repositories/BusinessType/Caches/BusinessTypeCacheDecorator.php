<?php

namespace App\Repositories\BusinessType\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\BusinessType\Interfaces\BusinessTypeInterface;

class BusinessTypeCacheDecorator extends CacheAbstractDecorator implements BusinessTypeInterface
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
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getListByCode($prependList = array(), $appendList = array(), $company_code)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
