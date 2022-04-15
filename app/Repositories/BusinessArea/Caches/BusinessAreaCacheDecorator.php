<?php

namespace App\Repositories\BusinessArea\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\BusinessArea\Interfaces\BusinessAreaInterface;

class BusinessAreaCacheDecorator extends CacheAbstractDecorator implements BusinessAreaInterface
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
