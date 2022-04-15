<?php

namespace App\Repositories\PurchaseOrder\Eloquent;

use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderItemInterface;

class PurchaseOrderItemRepository extends RepositoriesAbstract implements PurchaseOrderItemInterface
{
    /**
     * GetList For Select
     *
     * @param integer $purchaseOrderId
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getListByPOId($purchaseOrderId, $prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(ITEM_NO, " | ", DESCRIPTION1) AS title'), 'id'])->where([
            'purchase_order_id' => $purchaseOrderId
        ])->get()->toArray();
        $list = array_column($data, 'title', 'id');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
