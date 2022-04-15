<?php

namespace App\Http\Requests\MaterialCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class MaterialCodeRequest extends Request
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
            'material_code'      => 'required|max:7|min:7|unique:material_code,material_code,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'material_code.required' => 'Please enter Material code.',
        ];
    }
}
