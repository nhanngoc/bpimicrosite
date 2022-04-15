<?php

namespace App\Services\SaleOrder\Abstracts;


use App\Models\SaleOrderItem;
use App\Repositories\SaleOrder\Interfaces\SaleOrderItemInterface;
use Illuminate\Http\Request;

abstract class StoreSaleOrderItemServiceAbstract
{
    protected $saleOrderItemRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     *
     * @param SaleOrderItemInterface $saleOrderItemRepository
     */
    public function __construct(SaleOrderItemInterface $saleOrderItemRepository)
    {
        $this->saleOrderItemRepository = $saleOrderItemRepository;
    }

    /**
     * @param Request $request
     * @param SaleOrderItem $saleOrderItem
     * @return mixed
     */
    abstract public function execute(Request $request, SaleOrderItem $saleOrderItem);
}
