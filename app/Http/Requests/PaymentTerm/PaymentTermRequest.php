<?php

namespace App\Http\Requests\PaymentTerm;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PaymentTermRequest extends Request
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
            'payment_term'      => 'required|max:4|min:3|unique:payment_term,payment_term,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'payment_term.required' => 'Please enter Plant Code.',
        ];
    }
}
