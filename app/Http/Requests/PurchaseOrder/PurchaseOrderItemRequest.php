<?php

namespace App\Http\Requests\PurchaseOrder;

use App\Core\Support\Http\Requests\Request;

class PurchaseOrderItemRequest extends Request
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
            'ORIG_PRICE'    => 'required|max:20',
            'ORIG_QTY'      => 'required|max:16',
            'ORIG_UOM'      => 'required|max:5',
            'ORIG_AMOUNT'   => 'required|max:20',
            // 'ORIG_CURRENCY' => 'required|max:3',
            // 'ORIG_EX_RATE'  => 'required|max:9',
            'TAX_CODE'      => 'required|max:2',
            'REMARK'        => 'max:40',
            // 'CONTRACT_NO'   => 'max:20',
            // 'DROP_POINT_ID' => 'max:20'
        ];
    }
}
