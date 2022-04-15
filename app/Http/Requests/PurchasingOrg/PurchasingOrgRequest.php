<?php

namespace App\Http\Requests\PurchasingOrg;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PurchasingOrgRequest extends Request
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
            'purchasing_org'      => 'required|max:4|min:4|unique:purchasing_org',
        ];
    }

    public function messages()
    {
        return [
            'purchasing_org.required' => 'Please enter Purch. Org.',
        ];
    }
}
