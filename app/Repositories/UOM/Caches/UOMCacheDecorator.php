<?php

namespace App\Repositories\UOM\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\UOM\Interfaces\UOMInterface;

class UOMCacheDecorator extends CacheAbstractDecorator implements UOMInterface
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
