<?php

namespace App\Facades;

use App\Core\Support\MailVariable;
use Illuminate\Support\Facades\Facade;

class MailVariableFacade extends Facade
{

    /**
     * @return string
     *
     * @since 3.2
     */
    protected static function getFacadeAccessor()
    {
        return MailVariable::class;
    }
}
