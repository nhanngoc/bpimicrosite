<?php

namespace App\Http\Requests\CustomerVendor;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerVendorRequest extends Request
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
            'gname1'        => 'required|max:255',
            'add1'          => 'required|max:255',
            'country'       => 'required|max:2',
            'tax_code'      => 'required|max:255',
            'credit_term'   => 'required|max:4',
            'currency'      => 'required',
            // 'phone_no'=> 'digits:10|nullable',
            'phone_no'      => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'system_code'   => 'required|min:1|max:10|unique:customer_vendors,system_code',
        ];
    }

    public function messages()
    {
        return [
            'gname1.required' => 'Please enter Company Name.',
            'add1.required'   => 'Please enter address line 1.'
        ];
    }
}
