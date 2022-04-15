<?php

namespace App\Http\Requests\Tariff;


use App\Core\Base\Enums\BaseStatusEnum;
use App\Core\Support\Http\Requests\Request;
use App\Enums\Tariff\TariffEnum;
use Illuminate\Validation\Rule;

class TariffRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'               => 'required|max:255',
            'start_date'         => 'required',
            'end_date'           => 'required',
            'customer_vendor_id' => 'required',
            'notes'              => 'max:255',
            'status'             => Rule::in(TariffEnum::values()),
        ];
        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'name.required'               => 'Please enter Tariff name',
            'start_date.required'         => 'Please enter Starting date',
            'end_date.required'           => 'Please enter Expiring date',
            'notes.required'              => 'Please enter Remarks',
            'customer_vendor_id.required' => 'Please choose Customer/Vendor'
        ];
    }
}

