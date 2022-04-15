<?php

namespace App\Repositories\ChargeCode\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\ChargeCode\Interfaces\ChargeCodeInterface;

class ChargeCodeCacheDecorator extends CacheAbstractDecorator implements ChargeCodeInterface
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
     * @param $key
     * @return mixed|void
     */
    public function getSearchChargeCode($key)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * @param $charge_code
     * @return mixed
     */
    public function getDetailByChargeCode($charge_code)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
