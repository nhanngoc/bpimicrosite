<?php

namespace App\Services\SaleOrder;


use App\Models\SaleOrder;
use App\Services\SaleOrder\Abstracts\SapSaleOrderServiceAbstract;
use Illuminate\Http\Request;

class SapSaleOrderService extends SapSaleOrderServiceAbstract
{
    public function execute(Request $request, SaleOrder $saleOrder)
    {
        // TODO: Implement execute() method.
    }
}
