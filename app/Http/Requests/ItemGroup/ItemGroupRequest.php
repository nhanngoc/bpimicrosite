<?php

namespace App\Http\Requests\ItemGroup;

use App\Core\Support\Http\Requests\Request;

class ItemGroupRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'         => 'required|max:250',
            'item_numbers' => 'required'
        ];
    }
}
