<?php

namespace App\Http\Requests\PortCode;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PortCodeRequest extends Request
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
            'port_code'      => 'required|max:5|min:5|unique:port,port_code,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'port_code.required' => 'Please enter Port code.',
        ];
    }
}
