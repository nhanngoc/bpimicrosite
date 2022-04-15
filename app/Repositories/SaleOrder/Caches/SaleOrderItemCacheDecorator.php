<?php

namespace App\Repositories\SaleOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\SaleOrder\Interfaces\SaleOrderItemInterface;

class SaleOrderItemCacheDecorator extends CacheAbstractDecorator implements SaleOrderItemInterface
{

}
