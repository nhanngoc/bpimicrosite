<?php

namespace App\Services\PurchaseOrder\Import;

use App\Models\ItemNumber;
use App\Models\CompanyCode;
use App\Models\CustomerVendor;
use App\Models\PurchaseOrderANS;
use App\Models\PurchaseOrderANSItem;
use App\Models\PurchasingDocType;
use App\Repositories\Tariff\Interfaces\TariffInterface;

class ImportNPOService
{
    /**
     * Validate import data: PO Head
     */
    public function validateNPOHeadData($row, $company_code)
    {
        $errorStatus = false;
        $errors = array();
        if ($row['company_code'] == null || !$company_code) {
            $errorStatus = true;
            $errors['company_code'] = 'Company code not exist.';
        }
        if ($row['currency'] == null || !in_array($row['currency'], ['VND', 'USD'])) {
            $errorStatus = true;
            $errors['currency'] = 'Currency haven\'t value.';
        }
        $purchasingDocType = PurchasingDocType::where([
            'type' => 'non-approval'
        ])->get()->pluck('purchasing_doc_type');
        if ($row['purchasing_doc_type'] == null || !in_array($row['purchasing_doc_type'], $purchasingDocType->toArray())) {
            $errorStatus = true;
            $errors['purchasing_doc_type'] = 'Payment term haven\'t value or not exist.';
        }
        if (!checkPaymentTerm($row['payment_term'], ['payment_term'  => $row['payment_term']])) {
            $errorStatus = true;
            $errors['payment_term'] = 'Payment term haven\'t value.';
        }
        if (!checkIncoterms($row['incoterms'], ['incoterms' => $row['incoterms']])) {
            $errorStatus = true;
            $errors['incoterms'] = 'Incoterms haven\'t value or not exist.';
        }
        $businessType = checkBusinessType($row['business_type'], [
            'business_type' => $row['business_type'],
            'company_code'  => $row['company_code']
        ]);
        if (!$businessType) {
            $errorStatus = true;
            $errors['business_type'] = 'Business type haven\'t value or not exist.';
        } else {
            $tradeTypes = $businessType->tradeTypes->pluck('trade_type')->toArray();
            $cargoTypes = $businessType->cargoTypes->pluck('cargo_type')->toArray();
            $locationCodes = $businessType->locationCodes->pluck('location_code')->toArray();
            if (!in_array($row['trade_type'], $tradeTypes)) {
                $errorStatus = true;
                $errors['trade_type'] = 'Trade type haven\'t value or not exist.';
            }
            if (!in_array($row['cargo_type'], $cargoTypes)) {
                $errorStatus = true;
                $errors['cargo_type'] = 'Cargo type haven\'t value or not exist.';
            }
            if (!in_array($row['location'], $locationCodes)){
                $errorStatus = true;
                $errors['location'] = 'Location haven\'t value or not exist.';
            }
        }
        if ($row['doc_date'] == null) {
            $errorStatus = true;
            $errors['doc_date'] = 'Doc date haven\'t value.';
        }
        $vendor = CustomerVendor::where('contact_code', '=', $row['vendor_id'])->whereIn('vendor_or_customer', ['V', 'B'])->first();
        if (!$vendor || $row['vendor_id'] == null) {
            $errorStatus = true;
            $errors['vendor_id'] = 'Vendor haven\'t value or not exist.';
        }
        if ($row['invoice'] == null) {
            $errorStatus = true;
            $errors['invoice'] = 'Invoice haven\'t value.';
        }
        if (!checkPeriod($row['period'], ['period' => $row['period']])) {
            $errorStatus = true;
            $errors['period'] = 'Period haven\'t value or not correct.';
        }
        if (!$errorStatus) {
            return [
                'error'     => $errorStatus,
                'message'   => $errors,
                'vendor'    => $vendor
            ];
        }
        return [
            'error'     => $errorStatus,
            'message'   => $errors
        ];
    }

    /**
     * Validate import data: PO Item
     */
    public function validateNPOItemData($row, $vendor)
    {
        $errorStatus = false;
        $errors = array();
        $tariffPrice = 0;
        $itemNumber = ItemNumber::where([
            'item_no'       => $row['item_no'],
            'company_code'  => $row['company_code'],
            'type'          => 'PO'
        ])->first();
        if (!$itemNumber || $row['item_no'] == null) {
            $errorStatus = true;
            $errors['item_no'] = 'Item number haven\'t value not exist.';
        }
        //Check tariff price == price
        if ($itemNumber) {
            $tariffPrice = app(TariffInterface::class)->getPriceByTariff($vendor, $itemNumber);
            if ($row['item_price'] != $tariffPrice && $tariffPrice < 0) {
                $errorStatus = true;
                $errors['price'] = 'Price not equal tariff price.';
            }
        }
        //check quantity > 0
        if ($row['item_qty'] == null || $row['item_qty'] <= 0) {
            $errorStatus = true;
            $errors['item_qty'] = 'Quantity haven\'t value or quantity <= 0.';
        }
        //check UOM required
        if ($row['item_uom'] == null) {
            $errorStatus = true;
            $errors['uom'] = 'UOM haven\'t value.';
        }
        //check Tax required
        if ($row['tax_code'] == null) {
            $errorStatus = true;
            $errors['tax'] = 'Tax haven\'t value.';
        }
        if (!$errorStatus) {
            return [
                'error'         => $errorStatus,
                'message'       => $errors,
                'itemNumber'    => $itemNumber,
                'tariffPrice'   => $tariffPrice
            ];
        }
        return [
            'error'     => $errorStatus,
            'message'   => $errors
        ];
    }

    public function import($rows)
    {
        $no = 0;
        $po = null;
        $errorNo = 0;
        $errorData = array();
        $response = "";
        foreach ($rows[0] as  $key => $row) {
            $vendor = null;
            if ($row['purchase_order_id'] ==  null) {
                
                if ($errorNo == $row['no']) {
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => '']);
                    continue;
                }
                $company_code = CompanyCode::where(['code' => $row['company_code']])->first();
                $validateNPOHead = $this->validateNPOHeadData($row, $company_code);
                if ($validateNPOHead['error']) {
                    $errorNo = $row['no'];
                    $response = implode(', ', $validateNPOHead['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => '']);
                    continue;
                }
                $vendor = $validateNPOHead['vendor'];
                if ($no != $row['no']) {
                    // Insert PO
                    $npo = $this->importNPOHead($row, $company_code);
                    $no = $row['no'];

                    $npo->po_id = generate_po_id($npo->id, 'NP', $npo->company_code);
                    $npo->save();
                    $po = $npo;
                }

                //validate PO item
                $validateNPOItem = $this->validateNPOItemData($row, $vendor);
                if ($validateNPOItem['error']) {
                    $response = implode(', ', $validateNPOItem['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => $po->id]);
                    continue;
                }
                $npo_item = $this->importNPOItem($row, $po->id, $validateNPOItem['itemNumber'], $validateNPOItem['tariffPrice']);
            } else {
                //validate PO item
                $vendor = CustomerVendor::where('contact_code', '=', $row['vendor_id'])->whereIn('vendor_or_customer', ['V', 'B'])->first();
                $validateNPOItem = $this->validateNPOItemData($row, $vendor);
                if ($validateNPOItem['error']) {
                    $response = implode(', ', $validateNPOItem['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => $row['purchase_order_id']]);
                    continue;
                }
                $npo_item = $this->importNPOItem($row, $row['purchase_order_id'], $validateNPOItem['itemNumber'], $validateNPOItem['tariffPrice']);
            }
        }
        return $errorData;
    }

    public function importNPOHead($row, $company_code)
    {
        return PurchaseOrderANS::create([
            'po_id'                 => null,
            'CompanyCode'           => $company_code->code,
            'PlantCode'             => $company_code->plant,
            'PurchasingOrg'         => $company_code->purchasing_org,
            'PurchasingDocType'     => $row['purchasing_doc_type'],
            'VendorID'              => $row['vendor_id'],
            'Currency'              => $row['currency'],
            'PaymentTerm'           => $row['payment_term'],
            'Incoterms'             => $row['incoterms'],
            'DocDate'               => $row['doc_date'],
            // 'RoutingCode'           => $row['routing_code'],
            'WorkCenter'            => $row['work_center'],
            'HBK'                   => $row['hbk'],
            'EndUser'               => $row['end_user'],
            'AgentCode'             => $row['agent_code'],
            'Salesman'              => $row['salesman'],
            'CarrierCode'           => $row['carrier_code'],
            'CarrierType'           => $row['carrier_type'],
            'AreaFrom'              => $row['area_from'],
            'AreaTo'                => $row['area_to'],
            'EndUserGrp'            => $row['end_user_grp'],
            'TradeType'             => $row['trade_type'],
            'CargoType'             => $row['cargo_type'],
            'BusinessType'          => $row['business_type'],
            'Location'              => $row['location'],
            'Period'                => $row['period'],
            'POL'                   => $row['pol'],
            'POD'                   => $row['pod'],
            'PLD'                   => $row['pld'],
            'VendorOrigInvNo'       => $row['vendor_orig_inv_no'],
            'VendorInvNo'           => $row['vendor_inv_no'],
            'MJobNo'                => $row['mjob_no'],
            'InterCoMjob'           => $row['inter_co_mjob'],
            'OrigPONo'              => $row['orig_po_no'],
            'ETA'                   => $row['eta'],
            'ETD'                   => $row['etd'],
            'ExPostingDate'         => $row['ex_posting_date'],
            'ExPostingDate2'        => $row['ex_posting_date2'],
            'CargoClass'            => $row['cargo_class'],
            'Region'                => $row['region'],
            'BLNo'                  => $row['bl_no'],
            'ProcessType'           => $row['process_type'],
            'ProcessNo'             => $row['process_no'],
            'RefNo'                 => $row['ref_no'],
            'RefNo1'                => $row['ref_no1'],
            'RefNo2'                => $row['ref_no2'],
            'RefNo3'                => $row['ref_no3'],
            'RefNo4'                => $row['ref_no4'],
            'RefNo5'                => $row['ref_no5'],
            'RefNo6'                => generate_ref_no6($row['purchasing_doc_type']),
            'RefNo7'                => $row['ref_no7'],
            'ExecuteDate'           => $row['execute_date'],
            'VehicleType'           => $row['vehicle_type'],
            'TripType'              => $row['trip_type'],
            'Transaction'           => $row['transaction'],
            'ShipperCode'           => $row['shipper_code'],
            'ShipperName'           => $row['shipper_name'],
            'ConsigneeCode'         => $row['consignee_code'],
            'ConsigneeName'         => $row['consignee_name'],
            'NetWeight'             => $row['net_weight'],
            'GrossWeight'           => $row['gross_weight'],
            'SET'                   => $row['set'],
            'M3'                    => $row['m3'],
            'KG'                    => $row['kg'],
            'Labour'                => $row['labour'],
            'Qty'                   => $row['qty'],
            'UOM'                   => $row['uom'],
            'ManSOIndicator'        => $row['man_so_indicator'],
            'ExchangeRate'          => $row['exchange_rate'],
            'RefNoType'             => $row['ref_no_type'],
            'OrgDoc'                => $row['org_doc'],
            'Invoice'               => $row['invoice'],
            'BusinessArea'          => $row['business_area'],
            'SystemNo'              => 'DWH',
            'MBKNo'                 => $row['mbk_no'],
            'UserNo'                => \Auth::user()->first_name . ' ' . \Auth::user()->last_name,
            'created_by'            => \Auth::user()->id,
            'department_id'         => \Auth::user()->department_id,
            'type'                  => 'non-approval',
            'Status'                => 'new',
            'response'              => '',
        ]);
    }

    public function importNPOItem($row, $npoID, $itemNumber, $tariffPrice)
    {
        return PurchaseOrderANSItem::create([
            'purchase_order_ans_id'     => $npoID,
            'ITEM_NO'                   => $itemNumber->item_no,
            'MATERIAL_CODE'             => $itemNumber->material_code,
            'DESCRIPTION1'              => $row['description1'],
            'DESCRIPTION2'              => $row['description2'],
            'PRICE'                     => ($tariffPrice > 0) ? $tariffPrice : $row["item_price"],
            'QTY'                       => $row["item_qty"],
            'UOM'                       => $row["item_uom"],
            'CURRENCY'                  => $row["currency"],
            'TAX_CODE'                  => $row["tax_code"],
            'NET_VALUE'                 => $row["item_net_value"],
            'EX_RATE'                   => $row["exchange_rate"],
            'ORIG_PRICE'                => $row['orig_price'],
            'ORIG_QTY'                  => $row['orig_qty'],
            'ORIG_UOM'                  => $row['orig_uom'],
            'ORIG_AMOUNT'               => $row['orig_amount'],
            'ORIG_CURRENCY'             => $row['orig_currency'],
            'ORIG_EX_RATE'              => $row['orig_ex_rate'],
            'CONTAINER_TYPE'            => $row["container_type"],
            'CONTRACT_NO'               => $row['contract_no'],
            'CONTRACT_ITEM_NO'          => $row['contract_item_no'],
            'CONTRACT_SUB_ITEM_NO'      => $row['contract_sub_item_no'],
            'SUB_ACCOUNT_NO'            => $row['sub_account_no'],
            'SEASON_CODE'               => $row['season_code'],
            'DROP_POINT_ID'             => $row['drop_point_id'],
            'REF_DOC1'                  => $row['ref_doc1'],
            'REF_DOC2'                  => $row['ref_doc2'],
            'REF_DOC3'                  => $row['ref_doc3'],
            'REF_DOC4'                  => $row['ref_doc4'],
        ]);
    }
}
