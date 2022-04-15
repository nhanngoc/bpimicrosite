<?php

namespace App\Repositories\SaleOrder\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\SaleOrder\Interfaces\SaleOrderResponseInterface;

class SaleOrderResponseCacheDecorator extends CacheAbstractDecorator implements SaleOrderResponseInterface
{

}
