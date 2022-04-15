<?php

namespace App\Repositories\MaterialCode\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\MaterialCode\Interfaces\MaterialCodeInterface;

class MaterialCodeCacheDecorator extends CacheAbstractDecorator implements MaterialCodeInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
