<?php

namespace App\Services\SaleOrder\Import;

use App\Models\SaleOrder;
use App\Models\ItemNumber;
use App\Models\CompanyCode;
use App\Models\SaleOrderItem;
use App\Models\CustomerVendor;
use App\Services\SaleOrder\StoreSaleOrderService;
use App\Services\SaleOrder\StoreSaleOrderItemService;

class ImportSOService
{
    /**
     * Validate import data: SO Head
     */
    public function validateSOHeadData($row, $company_code)
    {
        $errorStatus = false;
        $errors = array();
        // Check company code
        if ($row['company_code'] == null || !$company_code) {
            $errorStatus = true;
            $errors['company_code'] = 'Company code not exist.';
        }
        //check currency
        if ($row['currency'] == null || !in_array($row['currency'], ['VND', 'USD'])) {
            $errorStatus = true;
            $errors['currency'] = 'Currency haven\'t value.';
        }
        //check SO doc type
        // $purchasingDocType = PurchasingDocType::where([
        //     'type' => 'non-approval'
        // ])->get()->pluck('purchasing_doc_type');
        // if ($row['purchasing_doc_type'] == null || !in_array($row['purchasing_doc_type'], $purchasingDocType->toArray())) {
        //     $errorStatus = true;
        //     $errors['purchasing_doc_type'] = 'Payment term haven\'t value or not exist.';
        // }
        //check payment term
        if (!checkPaymentTerm($row['payment_term'], ['payment_term'  => $row['payment_term']])) {
            $errorStatus = true;
            $errors['payment_term'] = 'Payment term haven\'t value.';
        }
        // Check document date
        if ($row['document_date'] == null) {
            $errorStatus = true;
            $errors['document_date'] = 'Document date haven\'t value.';
        }
        //Check customer, G/L Account C
        $customer = CustomerVendor::where('BPCode', '=', $row['customer'])
            ->where('acc_receivables_c', '=', $row['gl_account_c'])->whereIn('vendor_or_customer', ['C', 'B'])->first();
        if (!$customer || $row['customer'] == null || $row['gl_account_c'] == null) {
            $errorStatus = true;
            $errors['customer'] = 'Customer, G/L Account C haven\'t value or not exist.';
        }
        // Check period
        if (!checkPeriod($row['period'], ['period' => $row['period']])) {
            $errorStatus = true;
            $errors['period'] = 'Period haven\'t value or not correct.';
        }
        // Check document date
        if ($row['doc_amt'] === null) {
            $errorStatus = true;
            $errors['doc_amt'] = 'Doc Amt haven\'t value.';
        }
        // Check document date
        if ($row['local_amt'] === null) {
            $errorStatus = true;
            $errors['local_amt'] = 'Local Amt haven\'t value.';
        }
        // dd($errors);
        if (!$errorStatus) {
            return [
                'error'     => $errorStatus,
                'message'   => $errors,
                'customer'  => $customer
            ];
        }
        return [
            'error'     => $errorStatus,
            'message'   => $errors
        ];
    }

    /**
     * Validate import data: SO Item
     */
    public function validateSOItemData($row)
    {
        $errorStatus = false;
        $errors = array();
        $tariffPrice = 0;
        // Check item number
        $itemNumber = ItemNumber::where([
            'item_no'       => $row['item_no'],
            'company_code'  => $row['company_code'],
            'type'          => 'SO'
        ])->first();
        if (!$itemNumber || $row['item_no'] == null) {
            $errorStatus = true;
            $errors['item_no'] = 'Item number haven\'t value or not exist.';
        }
        //Check price
        if ($row['price'] != $tariffPrice && $tariffPrice < 0) {
            $errorStatus = true;
            $errors['price'] = 'Price havn\'t value.';
        }
        //check quantity > 0
        if ($row['qty'] == null || $row['qty'] <= 0) {
            $errorStatus = true;
            $errors['qty'] = 'Quantity haven\'t value or quantity <= 0.';
        }
        //check UOM required
        if ($row['uom'] == null) {
            $errorStatus = true;
            $errors['uom'] = 'UOM haven\'t value.';
        }
        //check Tax required
        if ($row['tax_code'] == null) {
            $errorStatus = true;
            $errors['tax'] = 'Tax haven\'t value.';
        }
        //check Tax required
        if ($row['net_value'] == null) {
            $errorStatus = true;
            $errors['net_value'] = 'Net Value haven\'t value.';
        }
        // Check GL Account item
        if ($row['gl_account_item'] == null) {
            $errorStatus = true;
            $errors['gl_account_item'] = 'G/L Account item haven\'t value.';
        }
        //Check business type, trade type, cargo type & warehouse
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
            if (!in_array($row['warehouse'], $locationCodes)) {
                $errorStatus = true;
                $errors['warehouse'] = 'Warehouse haven\'t value or not exist.';
            }
        }
        //check incoterms
        if (!checkIncoterms($row['incoterms'], ['incoterms' => $row['incoterms']])) {
            $errorStatus = true;
            $errors['incoterms'] = 'Incoterms haven\'t value or not exist.';
        }
        //check region
        if (!checkRegion($row['region'], ['region_code' => $row['region']])) {
            $errorStatus = true;
            $errors['region'] = 'Region haven\'t value or not exist.';
        }
        if (!$errorStatus) {
            return [
                'error'         => $errorStatus,
                'message'       => $errors,
                'itemNumber'    => $itemNumber
            ];
        }
        return [
            'error'     => $errorStatus,
            'message'   => $errors
        ];
    }

    public function import($rows, $request, StoreSaleOrderService $saleOrderService,StoreSaleOrderItemService $saleOrderItemService)
    {
        $no = 0;
        $so = null;
        $errorNo = 0;
        $errorData = array();
        $response = "";
        foreach ($rows[0] as  $key => $row) {
            $customer = null;
            if ($row['so_id'] ==  null) {

                if ($errorNo == $row['no']) {
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'so_id' => '']);
                    continue;
                }
                $company_code = CompanyCode::where(['code' => $row['company_code']])->first();
                $validateSOHead = $this->validateSOHeadData($row, $company_code);
                if ($validateSOHead['error']) {
                    $errorNo = $row['no'];
                    $response = implode(', ', $validateSOHead['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'so_id' => '']);
                    continue;
                }
                $customer = $validateSOHead['customer'];
                if ($no != $row['no']) {
                    // Insert PO
                    $sale_order = $this->importSOHead($row, $company_code);
                    $no = $row['no'];
                    $so = $sale_order;
                    if ($sale_order) {
                        $sale_order->statuses()->attach(1, [
                            'actioned_by' => \Auth::id()
                        ]);
                    }
                }

                //validate PO item
                $validateSOItem = $this->validateSOItemData($row);
                // dd($validateSOItem);
                if ($validateSOItem['error']) {
                    $response = implode(', ', $validateSOItem['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'so_id' => $so->id]);
                    continue;
                }
                $so_item = $this->importSOItem($row, $so->id, $validateSOItem['itemNumber']);
                dd($so, $so_item);
            } else {
                //validate PO item
                $validateSOItem = $this->validateSOItemData($row);
                if ($validateSOItem['error']) {
                    $response = implode(', ', $validateSOItem['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'so_id' => $row['so_id']]);
                    continue;
                }
                $so_item = $this->importSOItem($row, $row['so_id'], $validateSOItem['itemNumber'], $validateSOItem['tariffPrice']);
            }
        }
        return $errorData;
    }

    public function importSOHead($row, $company_code)
    {
        return SaleOrder::create([
            'CompanyCode'                  => $company_code->code,
            'PlantCode'                    => $company_code->plant,
            'Ledger'                       => $row['ledger'],
            'Period'                       => $row['period'],
            'DocumentDate'                 => $row['document_date'],
            // 'PostingDate'                  => $row['posting_date'],
            'DocumentType'                 => $row['document_type'],
            'DocumentHeaderText'           => $row['docheader_text'],
            'ExchangeRate'                 => $row['exchange_rate'],
            'Currency'                     => $row['currency'],
            'Customer'                     => $row['customer'],
            'ExternalGeneralLedgerAccount' => $row['gl_account_c'],
            'InternalGeneralLedgerAccount' => $row['gl_account_item'],
            'DocAmt'                       => $row['doc_amt'],
            'LocalAmt'                     => $row['local_amt'],
            'BusinessType'                 => $row['business_type'],
            'TradeType'                    => $row['trade_type'],
            'CargoType'                    => $row['cargo_type'],
            'Warehouse'                    => $row['warehouse'],
            // 'EndUser'                      => $row['end_user'],
            'Region'                       => $row['region'],
            'Incoterms'                    => $row['incoterms'],
            'MasterJob'                    => $row['master_job'],
            'SalesPerson'                  => $row['sales_person'],
            'Plant'                        => $company_code->plant,
            'SystemNumber'                 => 'DWH',
            'TaxCode'                      => $row['tax_code'],
            'PaymentTerm'                  => $row['payment_term'],
            'POl'                          => $row['pol'],
            'POD'                          => $row['pod'],
            'ShipperCode'                  => $row['shippercode'],
            'ShipperName'                  => $row['shippername'],
            'ConsigneeCode'                => $row['consigneecode'],
            'ConsigneeName'                => $row['consigneename'],
            'SoType'                       => generate_so_type($row['document_type']),
            'created_by'                   => \Auth::user()->id,
        ]);
    }

    public function importSOItem($row, $soID, $itemNumber)
    {
        return SaleOrderItem::create([
            'InternalGeneralLedgerAccount' => $row['gl_account_item'],
            'sale_order_id' => $soID,
            'ITEM_NO'       => $itemNumber->item_no,
            'MATERIAL_CODE' => $itemNumber->material_code,
            'DESCRIPTION1'  => $row['description1'],
            'PRICE'         => $row['price'],
            'QTY'           => $row['qty'],
            'UOM'           => $row['uom'],
            'TAX_CODE'      => $row['tax_code'],
            'NET_VALUE'     => $row['net_value'],
            'CURRENCY'      => $row['currency'],
            'EX_RATE'       => $row['exchange_rate'],
            'BusinessType'  => $row['business_type'],
            'TradeType'     => $row['trade_type'],
            'CargoType'     => $row['cargo_type'],
            'Warehouse'     => $row['warehouse'],
            'Region'        => $row['region'],
            'Incoterms'     => $row['incoterms'],
            'BusinessArea'  => $row['business_area'],
            'ReferenceKey1' => $row['reference_key_1'],
            'ReferenceKey2' => $row['reference_key_2'],
            'ReferenceKey3' => $row['reference_key_3'],
        ]);
    }
}
