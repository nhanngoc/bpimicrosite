<?php

namespace App\Http\Requests\User\Department;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends Request
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
            'name'      => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter Department name.',
        ];
    }
}
