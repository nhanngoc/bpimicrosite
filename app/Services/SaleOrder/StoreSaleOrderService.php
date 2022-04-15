<?php

namespace App\Services\SaleOrder;

use App\Models\SaleOrder;
use App\Services\SaleOrder\Abstracts\StoreSaleOrderServiceAbstract;
use Illuminate\Http\Request;

class StoreSaleOrderService extends StoreSaleOrderServiceAbstract
{
    /**
     * @param Request $request
     * @param SaleOrder $saleOrder
     * @return mixed|void
     */
    public function execute(Request $request, SaleOrder $saleOrder)
    {
        try {
            $DocAmount = 0;
            $LocalAmount = 0;
            if ($saleOrder->items->count() > 0) {
                foreach ($saleOrder->items as $item) {
                    if ($item->NET_VALUE > 0) {
                        $DocAmount = $DocAmount + $item->NET_VALUE;
                        $LocalAmount = $LocalAmount + $item->NET_VALUE;
                    }
                }
            }
            $saleOrder->DocAmt = $DocAmount;
            $saleOrder->save();
        } catch (\Exception $ex) {
            info($ex->getMessage());
        }
    }
}
