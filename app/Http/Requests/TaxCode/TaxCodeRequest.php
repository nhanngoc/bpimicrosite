<?php

namespace App\Http\Requests\TaxCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class TaxCodeRequest extends Request
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
            'tax_code'      => 'required|max:2|min:2|unique:tax_code,tax_code,' . $this->id . ',id',
            'value'         => 'required'
        ];
    }

    public function messages()
    {
        return [
            'tax_code.required' => 'Please enter Tax code.',
            'value.required' => 'Please enter Value.',
        ];
    }
}
