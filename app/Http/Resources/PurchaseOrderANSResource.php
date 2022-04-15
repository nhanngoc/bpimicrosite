<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseOrderANSResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $items = array();
        foreach ($request->purchaseOrderANSItems as $k => $item)
        {
            $items[$k]['ITEM_NO']              = $item->ITEM_NO;
            $items[$k]['MATERIAL_CODE']        = $item->MATERIAL_CODE;
            $items[$k]['DESCRIPTION1']         = $item->DESCRIPTION1;
            $items[$k]['DESCRIPTION2']         = $item->DESCRIPTION2;
            $items[$k]['PRICE']                = $item->PRICE;
            $items[$k]['QTY']                  = $item->QTY;
            $items[$k]['UOM']                  = $item->UOM;
            $items[$k]['TAX_CODE']             = $item->TAX_CODE;
            $items[$k]['NET_VALUE']            = $item->NET_VALUE;
            $items[$k]['CURRENCY']             = $item->CURRENCY;
            $items[$k]['EX_RATE']              = $item->EX_RATE;
            $items[$k]['CONTAINER_TYPE']       = $item->CONTAINER_TYPE;
            $items[$k]['ORIG_QTY']             = $item->ORIG_QTY;
            $items[$k]['ORIG_UOM']             = $item->ORIG_UOM;
            $items[$k]['ORIG_AMOUNT']          = $item->ORIG_AMOUNT;
            $items[$k]['ORIG_CURRENCY']        = $item->ORIG_CURRENCY;
            $items[$k]['ORIG_EX_RATE']         = $item->ORIG_EX_RATE;
            $items[$k]['REMARK']               = $item->REMARK;
            $items[$k]['CONTRACT_NO']          = $item->CONTRACT_NO;
            $items[$k]['CONTRACT_ITEM_NO']     = $item->CONTRACT_ITEM_NO;
            $items[$k]['CONTRACT_SUB_ITEM_NO'] = $item->CONTRACT_SUB_ITEM_NO;
            $items[$k]['SUB_ACCOUNT_NO']       = $item->SUB_ACCOUNT_NO;
            $items[$k]['SEASON_CODE']          = $item->SEASON_CODE;
            $items[$k]['DROP_POINT_ID']        = $item->DROP_POINT_ID;
            $items[$k]['REF_DOC1']             = $item->REF_DOC1;
            $items[$k]['REF_DOC2']             = $item->REF_DOC2;
            $items[$k]['REF_DOC3']             = $item->REF_DOC3;
            $items[$k]['REF_DOC4']             = $item->REF_DOC4;
        }

        return [
            'id'          => $request->id,
            'items'       => $request->purchaseOrderANSItems->count(),
            'header_main' => [
                'CompanyCode'           => $request->CompanyCode,
                'PlantCode'             => $request->PlantCode,
                'PurchasingOrg'         => $request->PurchasingOrg,
                'PurchasingDocType'     => $request->PurchasingDocType,
                'VendorID'              => $request->VendorID,
                'Currency'              => $request->Currency,
                'PaymentTerm'           => $request->PaymentTerm,
                'Incoterms'             => $request->Incoterms,
                'BillBlock'             => $request->BillBlock,
                'DocDate'               => date_format(date_create($request->DocDate), 'Ymd'),
                'Remarks1'              => $request->Remarks1,
                'Remarks2'              => $request->Remarks2,
                'Remarks3'              => $request->Remarks3,
                'Remarks4'              => $request->Remarks4,
                'Remarks5'              => $request->Remarks5,
                'Remarks6'              => $request->Remarks6,
                'Remarks7'              => $request->Remarks7,
                'RoutingCode'           => $request->RoutingCode,
                'WorkCenter'            => $request->WorkCenter,
                'HBK'                   => $request->HBK,
                'EndUser'               => $request->EndUser,
                'AgentCode'             => $request->AgentCode,
                'DirCNDNInt'            => $request->DirCNDNInt,
                'Salesman'              => $request->Salesman,
                'CarrierCode'           => $request->CarrierCode,
                'CarrierType'           => $request->CarrierType,
                'AreaFrom'              => $request->AreaFrom,
                'AreaTo'                => $request->AreaTo,
                'EndUserGrp'            => $request->EndUserGrp,
                'TradeType'             => $request->TradeType,
                'CargoType'             => $request->CargoType,
                'BusinessType'          => $request->BusinessType,
                'Location'              => $request->Location,
                'POL'                   => $request->POL,
                'POD'                   => $request->POD,
                'PLD'                   => $request->PLD,
                'VendorOrigInvNo'       => $request->VendorOrigInvNo,
                'VendorInvNo'           => $request->VendorInvNo,
                'MJobNo'                => $request->MJobNo,
                'InterCoMjob'           => $request->InterCoMjob,
                'ETA'                   => ($request->ETA != null) ? date_format(date_create($request->ETA), 'Ymd') : null,
                'ETD'                   => ($request->ETD != null) ? date_format(date_create($request->ETD), 'Ymd') : null,
                'OrigPONo'              => $request->OrigPONo,
                'ExPostingDate'         => ($request->ExPostingDate != null) ? date_format(date_create($request->ExPostingDate), 'Ymd') : null,
                'ExPostingDate2'        => ($request->ExPostingDate2 != null) ? date_format(date_create($request->ExPostingDate2), 'Ymd') : null,
                'UserNo'                => $request->UserNo,
                'CargoClass'            => $request->CargoClass,
                'Region'                => $request->Region,
                'BLNo'                  => $request->BLNo,
                'ProcessType'           => $request->ProcessType,
                'ProcessNo'             => $request->ProcessNo,
                'RefNo'                 => $request->RefNo,
                'RefNo1'                => $request->RefNo1,
                'RefNo2'                => $request->RefNo2,
                'RefNo3'                => $request->RefNo3,
                'RefNo4'                => $request->RefNo4,
                'RefNo5'                => $request->RefNo5,
                'RefNo6'                => $request->RefNo6,
                'RefNo7'                => $request->RefNo7,
                'ExecuteDate'           => $request->ExecuteDate,
                'VehicleType'           => $request->VehicleType,
                'TripType'              => $request->TripType,
                'Transaction'           => $request->Transaction,
                'MChargeCode1'          => $request->MChargeCode1,
                'MChargeCode2'          => $request->MChargeCode2,
                'HChargeCode1'          => $request->HChargeCode1,
                'HChargeCode2'          => $request->HChargeCode2,
                'ShipperCode'           => $request->ShipperCode,
                'ShipperName'           => $request->ShipperName,
                'ConsigneeCode'         => $request->ConsigneeCode,
                'ConsigneeName'         => $request->ConsigneeName,
                'NetWeight'             => $request->NetWeight,
                'GrossWeight'           => $request->GrossWeight,
                'SET'                   => $request->SET,
                'M3'                    => $request->M3,
                'KG'                    => $request->KG,
                'Labour'                => $request->Labour,
                'Qty'                   => $request->Qty,
                'UOM'                   => $request->UOM,
                'ManSOIndicator'        => $request->ManSOIndicator,
                'ExchangeRate'          => $request->ExchangeRate,
                'RefNoType'             => $request->RefNoType,
                'OrgDoc'                => $request->OrgDoc,
                'Invoice'               => $request->Invoice,
                'SystemNo'              => $request->SystemNo,
                'MBKNo'                 => $request->MBKNo,
            ],
            'item_main'   => $items
        ];
    }
}
