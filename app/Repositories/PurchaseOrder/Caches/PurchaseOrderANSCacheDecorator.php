<?php

namespace App\Repositories\PurchaseOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderANSInterface;

class PurchaseOrderANSCacheDecorator extends CacheAbstractDecorator implements PurchaseOrderANSInterface
{
    /**
     * @param $purchase_order_id
     * @return mixed
     */
    public function checkExistPurchaseOrderANSByID($purchase_order_id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
