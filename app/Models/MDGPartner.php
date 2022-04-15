<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MDGPartner extends Model
{
    //
    protected $table = 'mdg_partners';
    /**
     * @var string[]
     */
    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];
}
