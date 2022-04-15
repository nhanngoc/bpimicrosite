<?php

namespace App\Repositories\Period\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Period\Interfaces\PeriodInterface;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderInterface;

class PeriodCacheDecorator extends CacheAbstractDecorator implements PeriodInterface
{
    /**
     * @param bool $hasCondition
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array(), $hasCondition = false)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * @param $code
     * @return mixed
     */
    public function getByCode($code)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
