<?php

namespace App\Http\Requests\DocumentType;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class DocumentTypeRequest extends Request
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
            'document_type'      => 'required|max:2|min:2|unique:document_type,document_type,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'document_type.required' => 'Please enter Document type SO & Inventory.',
        ];
    }
}
