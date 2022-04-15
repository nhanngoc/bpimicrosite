<?php

namespace App\Repositories\SaleOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\SaleOrder\Interfaces\SaleOrderInterface;

class SaleOrderCacheDecorator extends CacheAbstractDecorator implements SaleOrderInterface
{

}
