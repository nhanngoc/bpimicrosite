<?php

namespace App\Repositories\Customer\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Customer\Interfaces\CustomerInterface;

class CustomerCacheDecorator extends CacheAbstractDecorator implements CustomerInterface
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
