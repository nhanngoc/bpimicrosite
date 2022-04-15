<?php

namespace App\Repositories\User\Caches;


use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\User\Interfaces\RoleInterface;

class RoleCacheDecorator extends CacheAbstractDecorator implements RoleInterface
{
    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $id)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = [], $appendList = [])
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    
    /**
     * @param string $slug
     * @return mixed
     */
    public function getUserListBySlug($slug)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
