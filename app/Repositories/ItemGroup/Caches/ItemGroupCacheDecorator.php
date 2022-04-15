<?php

namespace App\Repositories\ItemGroup\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\ItemGroup\Interfaces\ItemGroupInterface;
use App\Repositories\ItemNumber\Interfaces\ItemNumberInterface;

class ItemGroupCacheDecorator extends CacheAbstractDecorator implements ItemGroupInterface
{

}
