<?php

namespace App\Http\Requests\CustomerVendor;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerVendorEditRequest extends Request
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
            'gname1'      => 'required|max:255',
            'add1'        => 'required|max:255',
            'country'     => 'required|max:2',
            'tax_code'    => 'required|max:255',
            'credit_term' => 'required|max:4',
            'currency'    => 'required',
            // 'phone_no'=> 'digits:10|nullable',
            'phone_no'=> 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'system_code'   => 'required|min:1|max:10|unique:customer_vendors,system_code,' . $this->id .',id',
            'contact_code'   => 'required|max:6|unique:customer_vendors,contact_code,' . $this->id .',id', // Contact Code = MDG CODE
            'BPCode'        => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|max:10|unique:customer_vendors,BPCode,' . $this->id .',id',
        ];
        $vendor_or_customer = $this->input('vendor_or_customer');

        if ($vendor_or_customer === 'V') {
            $rules['acc_payable_v'] = 'required|digits_between:8,8|numeric';
        } else if ($vendor_or_customer === 'C') {
            $rules['acc_receivables_c'] = 'required|digits_between:8,8|numeric';
        } else {
            $rules['acc_payable_v'] = 'required|digits_between:8,8|numeric';
            $rules['acc_receivables_c'] = 'required|digits_between:8,8|numeric';
        }
        return $rules;
    }

    /**
     * @return array|string[]
     */
    public function messages()
    {
        return [
            'gname1.required'            => 'Please enter Company Name.',
            'add1.required'              => 'Please enter address line 1.',
            'BPCode.required'            => 'Please enter BP Code',
            'contact_code.required'      => 'Please enter Contact Code',
            'acc_payable_v.required'     => 'Please enter Recon Account (V)',
            'acc_receivables_c.required' => 'Please enter Recon Account (C)'
        ];
    }
}
