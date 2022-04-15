<?php

namespace App\Http\Requests\BusinessType;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class BusinessTypeRequest extends Request
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
            'business_type'         => 'required|max:2|min:2',
            'company_code'          => 'required',
        ];
    }

    public function messages()
    {
        return [
            'business_type.required' => 'Please enter Business type.',
            'company_code.required' => 'Please select Company Code.',
        ];
    }
}
