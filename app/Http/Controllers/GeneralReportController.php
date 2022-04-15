<?php

namespace App\Http\Controllers;

use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Repositories\TradeType\Interfaces\TradeTypeInterface;
use Illuminate\Http\Request;

class GeneralReportController extends Controller
{
    //
    protected $tradeTypeRepository;

    /**
     * GeneralReportController constructor.
     *
     * @param TradeTypeInterface $tradeTypeRepository
     */
    public function __construct(
        TradeTypeInterface $tradeTypeRepository
    )
    {
        $this->tradeTypeRepository = $tradeTypeRepository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getRevenue(Request $request)
    {
        $tradeTypes = $this->tradeTypeRepository->getList([
            '' => 'Select Trade type?'
        ], []);

        $businessTypes = [];
        page_title()->setTitle('General Report');
        if ($request->input('trade_type_id')) {
            $tradeType = $this->tradeTypeRepository->getFirstBy([
                'trade_type' => $request->input('trade_type_id')
            ]);
            if ($tradeType) {
                $businessTypes = $tradeType->businessTypes()->pluck('description', 'business_type');
            }
        }

        $filters = [
            'report_type'      => $request->input('report_type'),
            'start_date'       => $request->input('start_date'),
            'end_date'         => $request->input('end_date'),
            'trade_type_id'    => $request->input('trade_type_id'),
            'business_type_id' => $request->input('business_type_id'),
        ];

        return view('report.general.revenue', compact(
            'tradeTypes',
            'businessTypes'
        ));
    }

    /**
     * @param Request $request
     * @param BaseHttpResponse $response
     */
    public function postRevenue(Request $request, BaseHttpResponse $response)
    {
        try {


        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }
}
