<?php

namespace App\Repositories\PurchaseOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderInterface;

class PurchaseOrderCacheDecorator extends CacheAbstractDecorator implements PurchaseOrderInterface
{

}
