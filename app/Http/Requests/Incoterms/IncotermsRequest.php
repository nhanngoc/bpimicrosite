<?php

namespace App\Http\Requests\Incoterms;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class IncotermsRequest extends Request
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
            'incoterms'      => 'required|max:3|min:2|unique:incoterms,incoterms,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'incoterms.required' => 'Please enter Incoterms.',
        ];
    }
}
