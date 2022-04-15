<?php

namespace App\Repositories\DocumentType\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\DocumentType\Interfaces\DocumentTypeInterface;

class DocumentTypeCacheDecorator extends CacheAbstractDecorator implements DocumentTypeInterface
{
    public function getList($prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
