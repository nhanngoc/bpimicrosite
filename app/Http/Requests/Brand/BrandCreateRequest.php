<?php

namespace App\Http\Requests\Brand;

use App\Core\Support\Http\Requests\Request;

class BrandCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:110'
        ];
    }
}
