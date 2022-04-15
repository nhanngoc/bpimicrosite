<?php

namespace App\Http\Requests\CompanyCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CompanyCodeRequest extends Request
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
            'name'              => 'required|min:5',
            'code'              => 'required|min:4|max:4|unique:company_codes,code,' . $this->id . ',id',
            'plant'             => 'required|min:4|max:4|unique:company_codes,plant,' . $this->id . ',id',
            'purchasing_org'    => 'required|min:4|max:4|unique:company_codes,purchasing_org,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'name.required'             => 'Please enter Company name.',
            'code.required'             => 'Please enter Company code.',
            'plant.required'            => 'Please enter Company plant code.',
            'purchasing_org.required'   => 'Please enter Company purchasing org.',
        ];
    }
}
