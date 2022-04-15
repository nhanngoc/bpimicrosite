<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListSaleOrderItemResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'CompanyCode'  => (string)$this->ITEM_NO,
            'ItemNumber'   => $this->item_no ? $this->item_no->item_no : null,
            'MaterialCode' => $this->item_no ? $this->item_no->material_code : null,
            'DESCRIPTION1' => $this->DESCRIPTION1,
            'PRICE'        => number_format($this->PRICE, 2),
            'QTY'          => $this->QTY,
            'UOM'          => $this->UOM,
            'TAX_CODE'     => $this->TAX_CODE,
            'NET_VALUE'    => number_format($this->NET_VALUE),
            'CURRENCY'     => $this->CURRENCY,
            'EX_RATE'      => number_format($this->EX_RATE, 2),
            'BusinessType' => (string)$this->BusinessType,
            'TradeType'    => $this->TradeType,
            'CargoType'    => $this->CargoType,
            'Warehouse'    => $this->Warehouse,
            'Region'       => $this->Region,
            'Incoterms'    => $this->Incoterms,
            'BusinessArea' => $this->BusinessArea,
        ];
    }
}
