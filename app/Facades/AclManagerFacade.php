<?php

namespace App\Facades;

use App\Models\AclManager;
use Illuminate\Support\Facades\Facade;

class AclManagerFacade extends Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return AclManager::class;
    }
}
