<?php

namespace App\Repositories\PurchaseOrder\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface PurchaseOrderANSInterface extends RepositoryInterface
{

    public function checkExistPurchaseOrderANSByID($purchase_order_id);
}
