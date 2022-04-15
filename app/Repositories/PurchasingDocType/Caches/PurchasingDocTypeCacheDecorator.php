<?php

namespace App\Repositories\PurchasingDocType\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PurchasingDocType\Interfaces\PurchasingDocTypeInterface;

class PurchasingDocTypeCacheDecorator extends CacheAbstractDecorator implements PurchasingDocTypeInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($type, $prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
