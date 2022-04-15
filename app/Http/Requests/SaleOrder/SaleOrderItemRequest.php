<?php

namespace App\Http\Requests\SaleOrder;

use App\Core\Support\Http\Requests\Request;

class SaleOrderItemRequest extends Request
{
    /**
     * @return array
     */
    public function rules()
    {
        $rules = [
            'item_number_id'               => 'required',
            'InternalGeneralLedgerAccount' => 'required|digits_between:8,8|numeric',
            'PRICE'                        => 'required',
            'QTY'                          => 'required|max:13',
            'TAX_CODE'                     => 'required|max:2',
            'BusinessType'                 => 'required',
            'TradeType'                    => 'required',
            'CargoType'                    => 'required',
            'Warehouse'                    => 'required',
            'Region'                       => 'required',
            'Incoterms'                    => 'required',
        ];

        return $rules;
    }
}
