<?php

namespace App\Http\Requests\PurchaseOrder;

use App\Core\Support\Http\Requests\Request;

class PurchaseOrderANSRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'RoutingCode'           => 'required|max:7',
            'CompanyCode'           => 'required|min:4|max:4',
            // 'PlantCode'             => 'required|min:4|max:4',
            // 'PurchasingOrg'         => 'required|min:4|max:4',
            // 'PurchasingDocType'     => 'required|max:4',
            'VendorID'              => 'required|max:10',
            // 'Currency'              => 'required|max:3',
            // 'PaymentTerm'           => 'required|max:4',
            // 'Incoterms'             => 'required|max:3',
            'DocDate'               => 'required',
            'Period'               => 'required|min:6|max:6',
            // 'TradeType'             => 'required|max:2',
            // 'CargoType'             => 'required|max:3',
            // 'BusinessType'          => 'required|max:2',
            // 'Location'              => 'required|max:4',
            'UserNo'                => 'required',
            // 'Invoice'               => 'required|max:20',
            // 'SystemNo'              => 'required|max:6',
        ];

    }

    public function messages()
    {
        return [
            'RoutingCode.required'  => 'Please select Material Number.',
            'Invoice.required'      => 'Please enter Invoice.',
            'SystemNo.required'     => 'Please enter SystemNo.',
            'UserNo.required'       => 'Please enter UserNo.',
            'DocDate.required'      => 'Please select DocDate.'
        ];
    }
}
