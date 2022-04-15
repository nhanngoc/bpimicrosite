<?php

namespace App\Services\PurchaseOrder\Import;

use App\Models\ItemNumber;
use App\Models\CompanyCode;
use App\Models\PurchaseOrder;
use App\Models\CustomerVendor;
use App\Models\PurchaseOrderItem;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\APOErrorDataFromViewExport;
use App\Repositories\Tariff\Interfaces\TariffInterface;

class ImportPurchaseOrderService
{
    /**
     * Validate import data: PO Head
     */
    public function validatePOHeadData($row, $company_code)
    {
        $errorStatus = false;
        $errors = array();
        if ($row['company_code'] == null || !$company_code) {
            $errorStatus = true;
            $errors['company_code'] = 'Company code not exist.';
        }
        if ($row['currency'] == null) {
            $errorStatus = true;
            $errors['currency'] = 'Currency haven\'t value.';
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
            if (!in_array($row['warehouse_code'], $locationCodes)){
                $errorStatus = true;
                $errors['warehouse_code'] = 'Location haven\'t value or not exist.';
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
    public function validatePOItemData($row, $vendor)
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
            if ($row['price'] != $tariffPrice && $tariffPrice != 0) {
                $errorStatus = true;
                $errors['price'] = 'Price not equal tariff price.';
            }
        }
        //check quantity > 0
        if ($row['quantity'] == null || $row['quantity'] <= 0) {
            $errorStatus = true;
            $errors['quantity'] = 'Quantity haven\'t value or quantity <= 0.';
        }
        //check UOM required
        if ($row['uom'] == null) {
            $errorStatus = true;
            $errors['uom'] = 'UOM haven\'t value.';
        }
        //check Tax required
        if ($row['tax'] == null) {
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
                $validatePOHead = $this->validatePOHeadData($row, $company_code);
                if ($validatePOHead['error']) {
                    $errorNo = $row['no'];
                    $response = implode(', ', $validatePOHead['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => '']);
                    continue;
                }
                $vendor = $validatePOHead['vendor'];
                if ($no != $row['no']) {
                    // Insert PO
                    $purchase_order = $this->importPurchaseOrderHead($row, $company_code);
                    $no = $row['no'];

                    $purchase_order->po_id = generate_po_id($purchase_order->id, 'AP', $purchase_order->company_code);
                    $purchase_order->save();
                    $po = $purchase_order;
                }

                //validate PO item
                $validatePOItem = $this->validatePOItemData($row, $vendor);
                if ($validatePOItem['error']) {
                    $response = implode(', ', $validatePOItem['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => $po->id]);
                    continue;
                }
                $purchase_order_item = $this->importPurchaseOrderItem($row, $po->id, $validatePOItem['itemNumber'], $validatePOItem['tariffPrice']);
            } else {
                //validate PO item
                $vendor = CustomerVendor::where('contact_code', '=', $row['vendor_id'])->whereIn('vendor_or_customer', ['V', 'B'])->first();
                $validatePOItem = $this->validatePOItemData($row, $vendor);
                if ($validatePOItem['error']) {
                    $response = implode(', ', $validatePOItem['message']);
                    $errorData[] = array_merge($row->toArray(), ['response' => $response, 'purchase_order_id' => $row['purchase_order_id']]);
                    continue;
                }
                $purchase_order_item = $this->importPurchaseOrderItem($row, $row['purchase_order_id'], $validatePOItem['itemNumber'], $validatePOItem['tariffPrice']);
            }
        }
        return $errorData;
    }

    public function importPurchaseOrderHead($row, $company_code)
    {
        return PurchaseOrder::create([
            'po_id'               => null,
            'company_code'        => $company_code->code,
            'plant_code'          => $company_code->plant,
            'purchasing_org'      => $company_code->purchasing_org,
            'purchasing_doc_type' => 'NB',
            'doc_date'            => $row['doc_date'],
            'vendor_id'           => $row['vendor_id'],
            'currency'            => $row['currency'],
            'payment_term'        => $row['payment_term'],
            'incoterms'           => $row['incoterms'],
            'end_user'            => $row['end_user'],
            'trade_type'          => $row['trade_type'],
            'cargo_type'          => $row['cargo_type'],
            'business_type'       => $row['business_type'],
            'location'            => $row['warehouse_code'],
            'created_by'          => \Auth::user()->id,
            'department_id'       => \Auth::user()->department_id,
            'status'              => 'new'
        ]);
    }

    public function importPurchaseOrderItem($row, $purchaseOrderID, $itemNumber, $tariffPrice)
    {
        return PurchaseOrderItem::create([
            'purchase_order_id'    => $purchaseOrderID,
            'ITEM_NO'              => $row['item_no'],
            'MATERIAL_CODE'        => $itemNumber->material_code,
            'DESCRIPTION1'         => $row['description1'],
            'DESCRIPTION2'         => $row['description2'],
            'ORIG_PRICE'           => ($tariffPrice > 0) ? $tariffPrice : $row['price'],
            'ORIG_QTY'             => $row['quantity'],
            'ORIG_UOM'             => $row['uom'],
            'TAX_CODE'             => $row['tax'],
            'ORIG_AMOUNT'          => $row['amount'],
            'ORIG_CURRENCY'        => $row['currency'],
            'ORIG_EX_RATE'         => $row['ex_rate'],
            'REMARK'               => $row['remark'],
            'CONTRACT_NO'          => $row['contract_no'],
            'CONTRACT_ITEM_NO'     => $row['contract_item_no'],
            'CONTRACT_SUB_ITEM_NO' => $row['contract_sub_item_no'],
            'SUB_ACCOUNT_NO'       => $row['sub_account_no'],
            'SEASON_CODE'          => $row['season_code'],
            'DROP_POINT_ID'        => $row['drop_point_id'],
            'REF_DOC1'             => $row['ref_doc1'],
            'REF_DOC2'             => $row['ref_doc2'],
            'REF_DOC3'             => $row['ref_doc3'],
            'REF_DOC4'             => $row['ref_doc4'],
        ]);
    }
}
