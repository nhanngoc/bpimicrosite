<?php

namespace App\Http\Requests\Attribute;

use App\Core\Support\Http\Requests\Request;

class AttributeCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attribute_set_id' => 'required',
            'name'             => 'required|max:110'
        ];
    }
}
