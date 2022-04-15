<?php

namespace App\Repositories\TradeType\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Repositories\TradeType\Interfaces\TradeTypeInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class TradeTypeRepository extends RepositoriesAbstract implements TradeTypeInterface
{
    /**
     * GetList For Select ['trade_type' => 'value]
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(trade_type, " - ", description) AS title'), 'trade_type'])->get()->toArray();
        $list = array_column($data, 'title', 'trade_type');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }

    /**
     * GetList For Select ['id' => 'value]
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getIdList($prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(trade_type, " - ", description) AS title'), 'id'])->get()->toArray();
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
