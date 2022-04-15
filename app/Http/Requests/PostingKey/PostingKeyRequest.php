<?php

namespace App\Http\Requests\PostingKey;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PostingKeyRequest extends Request
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
            'posting_key'      => 'required|max:2|min:2|unique:posting_key,posting_key,' . $this->id . ',id',
        ];
    }

    public function messages()
    {
        return [
            'posting_key.required' => 'Please enter Posting key.',
        ];
    }
}
