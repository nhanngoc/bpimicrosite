<?php

namespace App\Services\PurchaseOrder\Abstracts;

use App\Models\PurchaseOrder;
use App\Repositories\PurchaseOrder\Interfaces\PurchaseOrderInterface;
use Illuminate\Http\Request;

abstract class StorePurchaseOrderANSServiceAbstract
{
    /**
     * @var
     */
    protected $purchaseOrderRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     *
     * @param PurchaseOrderInterface $purchaseOrderRepository
     */
    public function __construct(PurchaseOrderInterface $purchaseOrderRepository)
    {
        $this->purchaseOrderRepository = $purchaseOrderRepository;
    }

    /**
     * @param Request $request
     * @param PurchaseOrder $purchaseOrder
     * @return mixed
     */
    abstract public function execute(Request $request, PurchaseOrder $purchaseOrder);
}
