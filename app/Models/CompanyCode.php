<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CompanyCode extends Model
{
    /**
     * @var string
     */
    protected $table = 'company_codes';
    /**
     * @var string[]
     */
    protected $fillable = [
        'code',
        'plant',
        'purchasing_org',
        'name',
        'params'
    ];
    /**
     * @var string[]
     */
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * @param $value
     */
    public function setParamsAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['params'] = json_encode($value, JSON_UNESCAPED_UNICODE);
        }
    }

    /**
     * @param $value
     * @return mixed
     */
    public function getParamsAttribute($value)
    {
        return json_decode($value, false);
    }


    public function purchaseCode() : BelongsTo
    {
        return $this->belongsTo(PurchaseOrder::class, 'company_code');
    }

    /**
     * @return HasMany
     */
    public function businessTypes() : HasMany
    {
        return $this->hasMany(BusinessType::class, 'company_code', 'code');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function departments()
    {
        return $this->belongsToMany(Department::class, 'company_department', 'company_id', 'department_id')->withTimestamps();
    }

    /**
     * @return HasMany
     */
    /*public function businessTypes() : HasMany
    {
        return $this->hasMany(BusinessType::class);
    }*/
}
