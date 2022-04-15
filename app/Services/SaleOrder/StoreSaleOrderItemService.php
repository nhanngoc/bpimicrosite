<?php

namespace App\Services\SaleOrder;

use App\Models\SaleOrderItem;
use App\Models\Tariff;
use App\Repositories\ItemNumber\Interfaces\ItemNumberInterface;
use App\Repositories\TaxCode\Interfaces\TaxCodeInterface;
use App\Services\SaleOrder\Abstracts\StoreSaleOrderItemServiceAbstract;
use Illuminate\Http\Request;

class StoreSaleOrderItemService extends StoreSaleOrderItemServiceAbstract
{
    /**
     * @param Request $request
     * @param SaleOrderItem $saleOrderItem
     * @return mixed|void
     */
    public function execute(Request $request, SaleOrderItem $saleOrderItem)
    {
        try {
            $taxCode = $this->getNetValueTaxCode($request);
            $netValue = $this->getTotalPriceWithQty($request, $saleOrderItem);
            //dd($netValue);
            if ($saleOrderItem->CURRENCY == 'USD') {
                $netValue = $netValue * number_format($saleOrderItem->EX_RATE, 0, '', '');
            }
            if ($taxCode > 0) {
                $netValue = $netValue + (($netValue * $taxCode) / 100);
            }
            $saleOrderItem->NET_VALUE = number_format($netValue, 2, '.', ',');
            $saleOrderItem->save();

        } catch (\Exception $ex) {
            info($ex->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return int
     */
    private function getNetValueTaxCode(Request $request)
    {
        $tax_code_input = $request->input('TAX_CODE');
        $taxCode = app(TaxCodeInterface::class)->getFirstBy([
            'tax_code' => $tax_code_input
        ]);
        if ($taxCode) {
            return (int)$taxCode->value;
        }
        return 0;
    }

    /**
     * @param Request $request
     * @param SaleOrderItem $saleOrderItem
     * @return float|int
     */
    private function getTotalPriceWithQty(Request $request, SaleOrderItem $saleOrderItem)
    {
        $PRICE = (int)str_replace(',', '', $request->input('PRICE'));
        /*if ($request->input('PRICE') > 0) {
            $PRICE = (int)str_replace(',', '', $request->input('PRICE'));
            $item_number_id = $request->input('item_number_id');
            $qty = $request->input('QTY');
            $item_number = app(ItemNumberInterface::class)->findOrFail($item_number_id);
            if ($item_number) {
                if ($qty > 0) {
                    $tariff = Tariff::whereHas('itemNumbers', function ($query) use ($item_number_id, $qty) {
                        $query->where('item_number_tariffs.item_number_id', $item_number_id)
                            ->where(function ($query) use ($qty) {
                                $query->where('tariffs.min_value', '<=', $qty)->orWhere('tariffs.max_value', '>=', $qty);
                            });
                    })->first();
                    if ($tariff && $tariff->percentage > 0) {
                        $saleOrderItem->tariff_id = $tariff->id;
                        $saleOrderItem->save();
                        $PRICE = $PRICE - (($PRICE * $tariff->percentage) / 100);
                    }
                }
            }
        } else {
            $PRICE = (int)str_replace(',', '', $request->input('PRICE'));
        }*/

        return $PRICE * $request->input('QTY');
    }

    /**
     * @param Request $request
     * @return float|int|mixed
     */
    private function getTariffByItemNumber(Request $request)
    {
        $price = $request->input('PRICE');
        if ($request->has('item_number_id')) {
            $item_number_id = $request->input('item_number_id');
            $qty = $request->input('QTY');
            $tariff = Tariff::whereHas('itemNumbers', function ($query) use ($item_number_id, $qty) {
                $query->where('item_number_tariffs.item_number_id', $item_number_id)
                    ->where(function ($query) use ($qty) {
                        $query->where('tariffs.min_value', '<=', $qty)->orWhere('tariffs.max_value', '>=', $qty);
                    });
            })->first();
            if ($tariff) {
                if ($tariff->percentage > 0) {
                    $price = $price - (($tariff->percentage * $price) / 100);
                }
            }
        }

        return $price;
    }
}
