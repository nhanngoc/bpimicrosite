<?php

namespace App\Repositories\Tariff\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Tariff\Interfaces\TariffInterface;

class TariffCacheDecorator extends CacheAbstractDecorator implements TariffInterface
{
    public function getList($prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

     /**
     * @param string $vendor
     * @param ItemNumber $itemNumber
     * @return float
     */
    public function getPriceByTariff($vendor, $itemNumber)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
