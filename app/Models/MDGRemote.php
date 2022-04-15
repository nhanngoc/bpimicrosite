<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDGRemote extends Model
{
    protected $connection = 'sqlsrv';
    //
    protected $table = 'MDG_Partner';

}
