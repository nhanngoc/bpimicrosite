<?php

namespace App\Repositories\Tariff\Eloquent;

use App\Core\Base\Enums\BaseStatusEnum;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\Tariff\Interfaces\TariffInterface;
use DB;

class TariffRepository extends RepositoriesAbstract implements TariffInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        $data = $this->model->where('status', '=', BaseStatusEnum::PUBLISHED)->select([DB::raw('CONCAT(percentage, "% | ", name) AS title'), 'id'])->get()->toArray();
        $list = array_column($data, 'title', 'id');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }

     /**
     * @param CustomerVendor $vendor
     * @param ItemNumber $itemNumber
     * @return float
     */
    public function getPriceByTariff($vendor, $itemNumber)
    {
        $tariff = $this->model
            ->where('customer_vendor_id', '=', $vendor->id)
            ->where('status', '=', 'active')
            ->whereDate('start_date', '<=', now())
            ->whereDate('end_date', '>=', now())
            ->select(['*'])
            ->first();
        if (empty($tariff)) {
            return 0;
        } else {
            $item = $tariff->items->where('item_number_id', '=', $itemNumber->id)->first();
            if ($tariff->items->count() == 0 || empty($item)) {
                return 0;
            }
            
            return $item->price;
        }
        
    }
}
