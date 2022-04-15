<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListSaleOrderResource extends JsonResource
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
            'SoNumber'     => $this->SoNumber,
            'CompanyCode'  => $this->CompanyCode,
            'PlantCode'    => $this->PlantCode,
            'DocumentDate' => $this->DocumentDate,
            'DocAmount'    => $this->DocAmt,
            'ExchangeRate' => number_format($this->ExchangeRate, 2),
            'Currency'     => $this->Currency,
            'Status'       => $this->statuses->last()->name,
            'Items'        => $this->items->count() > 0 ? ListSaleOrderItemResources::collection($this->items) : null
        ];
    }
}
