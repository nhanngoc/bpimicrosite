<?php

namespace App\Http\Requests\ItemNumber;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class ItemNumberRequest extends Request
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
            'item_no'           => 'required|max:5|min:5|unique:item_number,item_no,' . $this->id . ',id',
            'material_code'     => 'required',
            'company_code'      => 'required'
        ];
    }

    public function messages()
    {
        return [
            'item_no.required' => 'Please enter Item No.',
            'company_code.required' => 'Please select Company Code.',
            'material_code.required' => 'Please select Material Code.'
        ];
    }
}
