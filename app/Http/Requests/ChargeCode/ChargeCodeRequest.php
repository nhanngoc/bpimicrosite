<?php

namespace App\Http\Requests\ChargeCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ChargeCodeRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $method = $this->method();
        return [
            'charge_code'      => 'required|max:2|min:2|unique:charge_code,charge_code,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'charge_code.required' => 'Please enter charge code.',
        ];
    }
}
