<?php

namespace App\Http\Requests\User;

use App\Core\Support\Http\Requests\Request;

class CreateUserRequest extends Request
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
            'email'                 => 'required|max:60|min:6|email|unique:users',
            'password'              => 'required|min:6',
            'password_confirmation' => 'required|same:password',
            'role_id'               => 'required'
        ];
    }
}
