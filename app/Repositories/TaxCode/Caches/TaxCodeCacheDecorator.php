<?php

namespace App\Repositories\TaxCode\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\TaxCode\Interfaces\TaxCodeInterface;

class TaxCodeCacheDecorator extends CacheAbstractDecorator implements TaxCodeInterface
{
    public function getList($type = "SO", $prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
