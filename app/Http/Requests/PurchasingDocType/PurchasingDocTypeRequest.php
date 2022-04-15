<?php

namespace App\Http\Requests\PurchasingDocType;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PurchasingDocTypeRequest extends Request
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
            'purchasing_doc_type'      => 'required|max:4|min:2|unique:purchasing_doc_type,purchasing_doc_type,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'purchasing_doc_type.required' => 'Please enter Purchasing Document Type.',
        ];
    }
}
