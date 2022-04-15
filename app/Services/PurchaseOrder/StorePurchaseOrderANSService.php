<?php

namespace App\Services\PurchaseOrder;

use App\Models\PurchaseOrder;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderANSInterface;
use App\Services\PurchaseOrder\Abstracts\StorePurchaseOrderANSServiceAbstract;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StorePurchaseOrderANSService extends StorePurchaseOrderANSServiceAbstract
{
    /**
     * @param Request $request
     * @param PurchaseOrder $purchaseOrder
     * @return mixed|void
     */
    public function execute(Request $request, PurchaseOrder $purchaseOrder)
    {
        try {
            $purchaseOrderANSRepository = app(PurchaseOrderANSInterface::class);
            if (!$purchaseOrderANSRepository->checkExistPurchaseOrderANSByID($purchaseOrder->id)) {
                $purchaseOrderANSRepository->createOrUpdate([
                    'purchase_order_id' => $purchaseOrder->id,
                    'CompanyCode'       => $purchaseOrder->company_code,
                    'PlantCode'         => $purchaseOrder->plant_code,
                    'PurchasingOrg'     => $purchaseOrder->purchasing_org,
                    'PurchasingDocType' => $purchaseOrder->purchasing_doc_type,
                    'VendorID'          => $purchaseOrder->vendor_id,
                    'Currency'          => $purchaseOrder->currency,
                    'PaymentTerm'       => $purchaseOrder->payment_term,
                    'RoutingCode'       => 'PL30000',
                    'Incoterms'         => $purchaseOrder->incoterms,
                    'TradeType'         => $purchaseOrder->trade_type,
                    'CargoType'         => $purchaseOrder->cargo_type,
                    'BusinessType'      => $purchaseOrder->business_type,
                    'Location'          => $purchaseOrder->location,
                    'EndUser'           => $purchaseOrder->end_user,
                    'DocDate'           => date_from_database($purchaseOrder->created_at, 'Y-m-d'),
                    'Invoice'           => 'INVNS211000159',
                    'SystemNo'          => 'DWH'
                ]);
            }

        } catch (\Exception $ex) {
            info($ex->getMessage());
            echo $ex->getMessage();
        }
        // TODO: Implement execute() method.
    }
}
