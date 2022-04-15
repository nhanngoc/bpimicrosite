<?php

namespace App\Http\Requests\LocationCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class LocationCodeRequest extends Request
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
            'location_code'      => 'required|max:4|unique:location,location_code,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'location_code.required' => 'Please enter Location code.',
        ];
    }
}
