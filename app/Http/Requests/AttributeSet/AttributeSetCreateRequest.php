<?php

namespace App\Http\Requests\AttributeSet;

use App\Core\Support\Http\Requests\Request;

class AttributeSetCreateRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => 'required|unique:attribute_sets|max:110',
            'description' => 'max:255'
        ];
    }
}
