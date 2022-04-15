<?php

namespace App\Http\Requests\Period;

use App\Core\Support\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class PeriodRequest extends Request
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
            'period'      => 'required|max:6|min:6|unique:period,period,' . $this->id . ',id',
            'starting_date' => 'required',
            'end_date' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'period.required' => 'Please enter Period code.',
            'starting_date.required' => 'Please enter Staring date',
            'end_date.required' => 'Please enter End date',
        ];
    }
}
