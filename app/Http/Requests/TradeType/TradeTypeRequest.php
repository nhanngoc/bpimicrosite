<?php

namespace App\Http\Requests\TradeType;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class TradeTypeRequest extends Request
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
            'trade_type'      => 'required|max:2|min:2|unique:trade_type,trade_type,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'trade_type.required' => 'Please enter Trade type.',
        ];
    }
}
