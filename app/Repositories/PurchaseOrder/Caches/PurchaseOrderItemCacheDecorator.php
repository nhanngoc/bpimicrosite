<?php

namespace App\Repositories\PurchaseOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderItemInterface;

class PurchaseOrderItemCacheDecorator extends CacheAbstractDecorator implements PurchaseOrderItemInterface
{
    /**
     * GetList For Select
     *
     * @param integer $purchaseOrderId
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getListByPOId($purchaseOrderId, $prependList = array(), $appendList = array()) {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
