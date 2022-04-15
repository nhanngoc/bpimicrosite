<?php

namespace App\Repositories\CompanyCode\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\CompanyCode\Interfaces\CompanyCodeInterface;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderInterface;

class CompanyCodeCacheDecorator extends CacheAbstractDecorator implements CompanyCodeInterface
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
     * @param $code
     * @return mixed
     */
    public function getByCode($code)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
