<?php

namespace App\Http\Requests\PurchaseOrder;

use App\Core\Support\Http\Requests\Request;

class PurchaseOrderRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            // 'company_code'        => 'required|max:4',
            // 'plant_code'          => 'required|max:4',
            // 'purchasing_org'      => 'required|max:4',
            // 'purchasing_doc_type' => 'required|max:4',
            'vendor_id'           => 'required|max:10',
            'currency'            => 'required|max:3',
            'payment_term'        => 'required|max:4',
            'incoterms'           => 'required|max:3',
            'trade_type'          => 'required|max:2',
            'cargo_type'          => 'required|max:3',
            'business_type'       => 'required|max:2',
            'location'            => 'max:4',
            'file'                => 'required|mimes:pdf',
            'doc_date'            => 'required'
        ];
    }
}
