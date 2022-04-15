<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /**
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
    ];

    /**
     * @var bool
     */

    /**
     * Return all value of specified setting.
     *
     * @param  string $name
     * @return Mixed
     */
    public static function getSetting($name)
    {
        //$instance = new static;
        $setting = self::where('name', '=', $name)->first();
        if (!$setting) {
            return false;
        }
        $setting->value = (empty($setting->value)) ?
            json_decode($setting->default, false) :
            json_decode($setting->value, false);
        return $setting->value;
    }
}
