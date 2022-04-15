<?php

namespace App\Facades;

use App\Supports\GeneralReportHelper;
use Illuminate\Support\Facades\Facade;

class GeneralReportHelperFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return GeneralReportHelper::class;
    }
}
