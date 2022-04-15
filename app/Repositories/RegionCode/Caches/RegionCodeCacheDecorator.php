<?php

namespace App\Repositories\RegionCode\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\RegionCode\Interfaces\RegionCodeInterface;

class RegionCodeCacheDecorator extends CacheAbstractDecorator implements RegionCodeInterface
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
}
