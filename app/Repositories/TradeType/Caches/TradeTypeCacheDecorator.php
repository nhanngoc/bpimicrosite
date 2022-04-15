<?php

namespace App\Repositories\TradeType\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\TradeType\Interfaces\TradeTypeInterface;

class TradeTypeCacheDecorator extends CacheAbstractDecorator implements TradeTypeInterface
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
