<?php

namespace App\Facades;


use App\Services\SAP\SapHelper;
use Illuminate\Support\Facades\Facade;

class ApiSapFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SapHelper::class;
    }
}
