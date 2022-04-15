<?php

namespace App\Services\SaleOrderInvoice;


use App\Models\SaleOrder;
use App\Services\SaleOrderInvoice\Abstracts\StoreSaleOrderInvoiceServiceAbstract;
use Illuminate\Http\Request;

class StoreSaleOrderInvoiceService extends StoreSaleOrderInvoiceServiceAbstract
{
    /**
     * @param Request $request
     * @param SaleOrder $saleOrder
     * @return mixed|void
     */
    public function execute(Request $request, SaleOrder $saleOrder)
    {
        $responses = $request->all();
        if (count($responses) > 0) {
            foreach ($responses as $response) {
                $insert = [
                    'sale_order_id' => $saleOrder->id,
                    'Invoice_No'    => $response['Invoice_No'],
                    'Issued_Date'   => date('Y-m-d', strtotime($response['Issued_Date'])),
                    'Status'        => $response['Status'],
                    'Published_at'  => date('Y-m-d H:i:s', strtotime($response['Published_at'])),
                    'Message'       => isset($response['Message']) ? $response['Message'] : null,
                    'Responses'     => $response
                ];
                $this->saleOrderInvoiceRepository->createOrUpdate($insert);
            }
            unset($response);
        }
    }
}
