<?php

namespace App\Http\Requests\BusinessArea;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class BusinessAreaRequest extends Request
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
            'business_area_code'      => 'required|max:4|min:4|unique:business_area,business_area_code,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'business_area_code.required' => 'Please enter charge code.',
        ];
    }
}
