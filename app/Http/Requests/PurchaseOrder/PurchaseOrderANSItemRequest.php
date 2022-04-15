<?php

namespace App\Http\Requests\PurchaseOrder;

use App\Core\Support\Http\Requests\Request;

class PurchaseOrderANSItemRequest extends Request
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
            'ITEM_NO'       => 'required|max:5',
            // 'MATERIAL_CODE' => 'required|max:18',
            // 'ORIG_PRICE'    => 'required|max:13',
            // 'ORIG_QTY'      => 'required|max:16',
            // 'ORIG_UOM'      => 'required|max:5',
            // 'ORIG_AMOUNT'   => 'required|max:13',
            // 'ORIG_CURRENCY' => 'required|max:3',
            // 'ORIG_EX_RATE'  => 'required|max:9',
            'TAX_CODE'      => 'required|max:2',
            'REMARK'        => 'max:40',
            // 'QTY'           => 'numeric',
            'PRICE'         => 'required',
            'UOM'           => 'required',
            'NET_VALUE'     => 'required',
            'CONTRACT_NO'   => 'max:20',
            'DROP_POINT_ID' => 'max:20'
        ];
    }

    public function messages()
    {
        return [
            //
            'ITEM_NO.required'       => 'Please enter ITEM_NO',
            // 'MATERIAL_CODE.required' => 'Please enter MATERIAL_CODE',
            'ORIG_PRICE.required'    => 'Please enter ORIG_PRICE',
            'ORIG_QTY.required'      => 'Please enter ORIG_QTY',
            'ORIG_UOM.required'      => 'Please enter ORIG_UOM',
            'ORIG_AMOUNT.required'   => 'Please enter ORIG_AMOUNT',
            'ORIG_CURRENCY.required' => 'Please enter ORIG_CURRENCY',
            'ORIG_EX_RATE.required'  => 'Please enter ORIG_EX_RATE',
        ];
    }
}
