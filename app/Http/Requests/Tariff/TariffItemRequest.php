<?php

namespace App\Http\Requests\Tariff;

use App\Core\Support\Http\Requests\Request;

class TariffItemRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'item_number_id' => 'required',
            'price'          => 'required',
            'description'    => 'max:255'
        ];
    }
}
