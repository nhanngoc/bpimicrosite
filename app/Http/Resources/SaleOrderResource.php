<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SaleOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        // Line For DocumentType
        if ($request->DocumentType == 'RV' || $request->DocumentType == 'DN' || $request->DocumentType == 'DR' || $request->DocumentType == 'ZP') {
            $lineCustomer = "01";
            $lineItem = 50;
        } else if ($request->DocumentType == 'DG' || $request->DocumentType == 'AB') {
            $lineCustomer = 11;
            $lineItem = 40;
        } else if ($request->DocumentType == 'SC') {
            $lineCustomer = 40;
            $lineItem = 50;
        }

        $line_items = [];

        $DocAmtTotal = 0;
        $LocalAmtTotal = 0;

        foreach ($request->items as $k => $item) {
            $DocAmt = $item->PRICE * $item->QTY;
            $LocalAmt = $item->PRICE * $item->QTY;
            if ($item->CURRENCY == 'USD') {
                $DocAmt = $item->PRICE * $item->QTY;
                $LocalAmt = ($item->PRICE * $item->QTY) * $item->EX_RATE;
            }
            $DocAmtTotal = $DocAmtTotal + $DocAmt;
            $LocalAmtTotal = $LocalAmtTotal + $LocalAmt;

            $line_items[$k]['BUKRS'] = $request->CompanyCode;
            $line_items[$k]['BSCHL'] = $lineItem;
            $line_items[$k]['WRBTR'] = $DocAmt;
            $line_items[$k]['DMBTR'] = $LocalAmt;
            $line_items[$k]['WW001'] = $request->BusinessType;
            $line_items[$k]['WW002'] = $request->TradeType;
            $line_items[$k]['WW003'] = $request->CargoType;
            $line_items[$k]['WW004'] = $request->Warehouse;
            $line_items[$k]['WW005'] = $request->EndUser;
            $line_items[$k]['WW006'] = $request->Region;
            $line_items[$k]['WW007'] = $request->Incoterms;
            $line_items[$k]['WW010'] = $request->MasterJob;
            $line_items[$k]['WW012'] = $request->SalesPerson;
            $line_items[$k]['WERKS'] = $request->Plant;
            $line_items[$k]['WW017'] = $request->SystemNumber;
            $line_items[$k]['MWSKZ'] = $item->TAX_CODE;
            $line_items[$k]['MATNR'] = $item->MATERIAL_CODE;
            $line_items[$k]['GSBER'] = $item->BusinessArea;
            $line_items[$k]['HKONT'] = $request->InternalGeneralLedgerAccount;
        }

        $line_customer = [
            'BUKRS' => $request->CompanyCode,
            'BSCHL' => $lineCustomer,
            'KUNNR' => $request->Customer,
            'WRBTR' => $DocAmtTotal,
            'DMBTR' => $LocalAmtTotal,
            'SGTXT' => $lineCustomer . ' ARLine',
            'ZUONR' => $lineCustomer . ' ARLine',
            'ZTERM' => $request->PaymentTerm,
            'HKONT' => $request->ExternalGeneralLedgerAccount
        ];

        return [
            'id'          => $request->id,
            'items'       => $request->items->count(),
            'header_main' => [
                'BUKRS' => $request->CompanyCode,
                'XBLNR' => $request->ReferenceDocumentNumber,
                'BLDAT' => $request->DocumentDate,
                'MONAT' => substr($request->Period, 0, 2),
                'BUDAT' => $request->DocumentDate,
                'BLART' => $request->DocumentType,
                'BKTXT' => $request->DocumentHeaderText,
                'KURSF' => $request->ExchangeRate,
                'WAERS' => $request->Currency,
            ],
            'item_main'   => [
                'line_customer' => $line_customer,
                'line_items'    => $line_items
            ]
        ];
    }
}
