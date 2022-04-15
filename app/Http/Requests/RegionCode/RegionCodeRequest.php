<?php

namespace App\Http\Requests\RegionCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class RegionCodeRequest extends Request
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
            'region_code'      => 'required|max:2|min:2|unique:region,region_code,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'region_code.required' => 'Please enter Region code.',
        ];
    }
}
