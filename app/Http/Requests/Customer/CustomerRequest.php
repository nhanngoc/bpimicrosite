<?php

namespace App\Http\Requests\Customer;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'first_name'      => 'required|max:20|min:1:customer,first_name' . $this->id . ',id',
        ];

        if ($this->method() == 'POST') {
            $rules['first_name'] = 'required|max:20|min:1:customer,first_name';
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'first_name.required' => 'Please enter first name.',
        ];
    }
}
