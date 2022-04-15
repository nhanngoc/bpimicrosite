<?php

namespace App\Http\Requests\User;

use App\Core\Support\Http\Requests\Request;

class EditUserRequest extends Request
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name'            => 'required|max:60|min:2',
            'last_name'             => 'required|max:60|min:2',
            'role_id'               => 'required'
        ];
    }
}
