<?php

namespace App\Services\SaleOrderInvoice\Abstracts;


use App\Models\SaleOrder;
use App\Models\SaleOrderInvoice;
use App\Models\SaleOrderItem;
use App\Repositories\SaleOrder\Interfaces\SaleOrderInterface;
use App\Repositories\SaleOrder\Interfaces\SaleOrderItemInterface;
use App\Repositories\SaleOrderInvoice\Interfaces\SaleOrderInvoiceInterface;
use Illuminate\Http\Request;

abstract class StoreSaleOrderInvoiceServiceAbstract
{
    /**
     * @var SaleOrderInterface
     */
    protected $saleOrderRepository;
    /**
     * @var SaleOrderInvoiceInterface
     */
    protected $saleOrderInvoiceRepository;

    /**
     * StoreSaleOrderInvoiceServiceAbstract constructor.
     *
     * @param SaleOrderInvoiceInterface $saleOrderInvoiceRepository
     * @param SaleOrderInterface $saleOrderRepository
     */
    public function __construct(
        SaleOrderInvoiceInterface $saleOrderInvoiceRepository,
        SaleOrderInterface $saleOrderRepository
    )
    {
        $this->saleOrderRepository = $saleOrderRepository;
        $this->saleOrderInvoiceRepository = $saleOrderInvoiceRepository;
    }

    /**
     * @param Request $request
     * @param SaleOrder $saleOrder
     * @return mixed
     */
    abstract public function execute(
        Request $request,
        SaleOrder $saleOrder
    );
}
