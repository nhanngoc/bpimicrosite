<?php

namespace App\Repositories\Acl\Caches;


use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\Acl\Interfaces\RoleInterface;

class RoleCacheDecorator extends CacheAbstractDecorator implements RoleInterface
{
    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    public function getList(array $prependList = [], array $appendList = [])
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    public function getUserListBySlug($slug, $company_code, $purchaseOrderPrice)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
