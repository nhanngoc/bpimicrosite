<?php

namespace App\Repositories\Incoterms\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Incoterms\Interfaces\IncotermsInterface;

class IncotermsCacheDecorator extends CacheAbstractDecorator implements IncotermsInterface
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
