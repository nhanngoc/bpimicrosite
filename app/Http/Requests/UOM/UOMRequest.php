<?php

namespace App\Http\Requests\UOM;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class UOMRequest extends Request
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
            'uom_code'      => 'required|max:3|min:3|unique:uom,uom_code,' . $this->id . ',id',
            'uom_text'      => 'required|min:2',
        ];
    }

    public function messages()
    {
        return [
            'uom_code.required' => 'Please enter UOM code.',
            'uom_text.required' => 'Please enter UOM text.',
        ];
    }
}
