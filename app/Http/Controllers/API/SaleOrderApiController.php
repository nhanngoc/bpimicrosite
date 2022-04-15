<?php

namespace App\Http\Controllers\API;

use App\Core\Base\Enums\BaseStatusEnum;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListSaleOrderResource;
use App\Models\SaleOrder;
use App\Repositories\SaleOrder\Interfaces\SaleOrderInterface;
use App\Services\SaleOrderInvoice\StoreSaleOrderInvoiceService;
use Illuminate\Http\Request;

class SaleOrderApiController extends Controller
{
    /**
     * @var SaleOrderInterface
     */
    protected $saleOrderRepository;

    /**
     * SaleOrderApiController constructor.
     *
     * @param SaleOrderInterface $saleOrderRepository
     */
    public function __construct(
        SaleOrderInterface $saleOrderRepository
    )
    {
        $this->saleOrderRepository = $saleOrderRepository;
    }
    //

    /**
     * Get List Sale Order
     *
     * @param Request $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Resources\Json\JsonResource
     */
    public function getListSaleOrder(Request $request, BaseHttpResponse $response)
    {
        $data = SaleOrder::whereHas('statuses', function ($query) {
            $query->where('status_id', '=', 2);
        })->orderByDesc("created_at")->get();
        return $response->setData(ListSaleOrderResource::collection($data))->toApiResponse();
    }

    /**
     * @param Request $request
     * @param StoreSaleOrderInvoiceService $saleOrderInvoiceService
     * @param BaseHttpResponse $response
     */
    public function receiveBill(
        Request $request,
        StoreSaleOrderInvoiceService $saleOrderInvoiceService,
        BaseHttpResponse $response
    )
    {
        try {
            if ($request->all()) {
                foreach ($request->all() as $invoice) {
                    $data_success = collect();
                    $data_errors = collect();
                    $saleOrder = $this->saleOrderRepository->getFirstBy([
                        'SoNumber' => $invoice['DW_SO'],
                    ]);
                    if ($saleOrder && $saleOrder->statuses->last()->code === 'S') {
                        if (!empty($invoice['Invoice_No'])) {
                            $saleOrder->ReferenceDocumentNumber = $invoice['Invoice_No'];
                            $saleOrder->save();
                            $saleOrder->statuses()->attach(3, [
                                'actioned_by' => 0
                            ]);
                            $saleOrderInvoiceService->execute($request, $saleOrder);
                            $data_success->push($invoice);
                            unset($invoice);
                        }
                    } else {
                        $data_errors->push($invoice);
                        unset($invoice);
                    }
                }
                \Log::info('Receive Bill : ', $request->all());
                return $response->setData(json_encode([
                    'data_success' => $data_success,
                    'data_errors'  => $data_errors
                ]))->toApiResponse();
            }

            return $response->setError()->setCode(500)->setMessage('Error Empty Request')->toApiResponse();
        } catch (\Exception $exception) {
            return $response->setError()->setCode(500)->setMessage('Error Empty Request')->toApiResponse();
        }
    }

    /**
     * @param array $invoice
     * @return mixed|null
     */
    protected function checkSaleOrder(array $invoice)
    {
        $saleOrder = $this->saleOrderRepository->getFirstBy([
            'id' => $invoice['DW_SO']
        ]);
        if ($saleOrder) {
            return $saleOrder;
        }
        return null;
    }
}
