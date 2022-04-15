<?php

namespace App\Repositories\PurchaseOrder\Eloquent;

use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderANSInterface;

class PurchaseOrderANSRepository extends RepositoriesAbstract implements PurchaseOrderANSInterface
{
    public function checkExistPurchaseOrderANSByID($purchase_order_id)
    {
        $query = $this->model->where('purchase_order_id', $purchase_order_id);
        $data = $this->applyBeforeExecuteQuery($query)->first();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
}
