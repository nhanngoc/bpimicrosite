<?php

namespace App\Repositories\PortCode\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PortCode\Interfaces\PortCodeInterface;

class PortCodeCacheDecorator extends CacheAbstractDecorator implements PortCodeInterface
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
