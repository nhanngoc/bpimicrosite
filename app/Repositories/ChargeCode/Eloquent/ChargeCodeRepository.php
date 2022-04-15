<?php

namespace App\Repositories\ChargeCode\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\ChargeCode\Interfaces\ChargeCodeInterface;
use Illuminate\Support\Facades\DB;

class ChargeCodeRepository extends RepositoriesAbstract implements ChargeCodeInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed|void
     */
    public function getList($prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(charge_code, " - ", description) AS title'), 'charge_code'])->get()->toArray();
        $list = array_column($data, 'title', 'charge_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }

    /**
     * @param string $key
     * @return mixed|void
     */
    public function getSearchChargeCode($key)
    {
        $data = $this->model->select('id', 'charge_code')
            ->where('charge_code.charge_code', 'like', '%' . $key . '%')
            ->orWhere('charge_code.description', 'like', '%' . $key . '%');
        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * @param $charge_code
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function getDetailByChargeCode($charge_code)
    {
        // TODO: Implement getDetailByChargeCode() method.
        $data = $this->model->select('id, charge_code, description')
            ->where('charge_code.charge_code', '=', $charge_code);
        return $this->applyBeforeExecuteQuery($data)->first();
    }
}
