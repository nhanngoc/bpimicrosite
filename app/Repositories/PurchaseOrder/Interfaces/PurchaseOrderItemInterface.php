<?php

namespace App\Repositories\PurchaseOrder\Interfaces;


use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface PurchaseOrderItemInterface extends RepositoryInterface
{
    /**
     * GetList For Select
     *
     * @param integer $purchaseOrderId
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getListByPOId($purchaseOrderId, $prependList = array(), $appendList = array());
}
