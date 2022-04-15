<?php

namespace App\Facades;


use App\Services\SAP\CancelSapHelper;
use Illuminate\Support\Facades\Facade;

class CancelSapFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CancelSapHelper::class;
    }
}
