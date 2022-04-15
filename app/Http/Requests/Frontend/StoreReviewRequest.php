<?php

namespace App\Http\Requests\Frontend;

use App\Core\Support\Http\Requests\Request;

class StoreReviewRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rating' => 'required|numeric',
            'reviewer_name' => 'required',
            'comment' => 'required',
            //'captcha' => 'required|captcha',
        ];
    }
}
