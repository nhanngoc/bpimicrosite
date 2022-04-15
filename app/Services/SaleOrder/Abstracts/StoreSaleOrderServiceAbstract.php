<?php

namespace App\Services\SaleOrder\Abstracts;

use App\Models\SaleOrder;
use App\Repositories\SaleOrder\Interfaces\SaleOrderInterface;
use Illuminate\Http\Request;

abstract class StoreSaleOrderServiceAbstract
{
    /**
     * @var
     */
    protected $saleOrderRepository;

    /**
     * StoreCategoryServiceAbstract constructor.
     *
     * @param SaleOrderInterface $saleOrderRepository
     */
    public function __construct(SaleOrderInterface $saleOrderRepository)
    {
        $this->saleOrderRepository = $saleOrderRepository;
    }

    /**
     * @param Request $request
     * @param SaleOrder $saleOrder
     * @return mixed
     */
    abstract public function execute(Request $request, SaleOrder $saleOrder);
}
