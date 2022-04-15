<?php

namespace App\Repositories\PaymentTerm\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\PaymentTerm\Interfaces\PaymentTermInterface;

class PaymentTermCacheDecorator extends CacheAbstractDecorator implements PaymentTermInterface
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
