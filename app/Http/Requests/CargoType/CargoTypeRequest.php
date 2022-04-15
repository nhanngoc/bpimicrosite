<?php

namespace App\Http\Requests\CargoType;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class CargoTypeRequest extends Request
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
            'cargo_type'      => 'required|max:3|min:3|unique:cargo_type,cargo_type,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'cargo_type.required' => 'Please enter Cargo type.',
        ];
    }
}
