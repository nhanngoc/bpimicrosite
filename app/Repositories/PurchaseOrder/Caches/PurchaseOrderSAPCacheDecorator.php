<?php

namespace App\Repositories\PurchaseOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderSAPInterface;

class PurchaseOrderSAPCacheDecorator extends CacheAbstractDecorator implements PurchaseOrderSAPInterface
{

}
