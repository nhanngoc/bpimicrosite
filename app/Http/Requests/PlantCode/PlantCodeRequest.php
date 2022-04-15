<?php

namespace App\Http\Requests\PlantCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PlantCodeRequest extends Request
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
            'plant'      => 'required|max:4|min:4|unique:plant_code',
        ];
    }

    public function messages()
    {
        return [
            'plant.required' => 'Please enter Plant Code.',
        ];
    }
}
