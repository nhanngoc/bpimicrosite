<?php

namespace App\Http\Requests\User;

use App\Core\Support\Http\Requests\Request;

class BrandEditRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:brands,name,' . $this->route('brand')
        ];
    }
}
