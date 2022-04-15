<?php

namespace App\Repositories\ItemNumber\Eloquent;

use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\ItemNumber\Interfaces\ItemNumberInterface;
use Illuminate\Support\Facades\DB;

class ItemNumberRepository extends RepositoriesAbstract implements ItemNumberInterface
{
    /**
     * Get List By Type
     *
     * @param array $prependList
     * @param array $appendList
     * @param string $type
     * @return array|mixed
     * @author JackiePham
     */
    public function getListByType($prependList = array(), $appendList = array(), $type = "SO")
    {
        $data = $this->model->where('type', '=', $type)->select([DB::raw('CONCAT(item_no, " | ", description) AS title'), 'id'])->get()->toArray();
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
     * GetList For Select
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(item_no, " | ", description) AS title'), 'item_no'])->get()->toArray();
        $list = array_column($data, 'title', 'item_no');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
    /**
     * GetList For Select
     *
     * @param array $purchaseOrderItems
     * @param string $companyCode
     * @param array $prependList
     * @param array $appendList
     * @param string $type SO or PO (default PO)
     * @return array|mixed
     */
    public function getListByPOItems($purchaseOrderItems, $companyCode, $prependList = array(), $appendList = array(), $type = 'PO')
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(item_no, " | ", description) AS title'), 'item_no'])->where([
            'company_code' => $companyCode,
            'type'         => $type
        ])->whereIn('item_no', $purchaseOrderItems)->get()->toArray();
        $list = array_column($data, 'title', 'item_no');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
    /**
     * GetList For Select
     *
     * @param string $companyCode
     * @param array $prependList
     * @param array $appendList
     * @param string $type SO or PO (default PO)
     * @return array|mixed
     */
    public function getListByCompanyCode($companyCode, $prependList = array(), $appendList = array(), $type = 'PO')
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(item_no, " | ", description) AS title'), 'item_no'])->where([
            'company_code' => $companyCode,
            'type'         => $type
        ])->get()->toArray();
        $list = array_column($data, 'title', 'item_no');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }

    /**
     * GetList For Select
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getListByMaterialCode($material_code, $company_code, $prependList = array(), $appendList = array())
    {
        // dd($material_code, $company_code);
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('item_no AS title'), 'item_no'])->where([
            'material_code' => $material_code,
            'company_code'  => $company_code
        ])->get()->toArray();
        // dd($data);
        $list = array_column($data, 'title', 'item_no');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        // dd($prependList);
        return $prependList;
    }

    /**
     * @param $code
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function getByCode($code)
    {
        $data = $this->model->where('item_no', $code);
        return $this->applyBeforeExecuteQuery($data)->first();
    }

    /**
     * @param string $key
     * @return mixed|void
     */
    public function getSearchItemNumber($key)
    {
        $data = $this->model->select('id', 'item_no')
            ->where('item_number.item_no', 'like', '%' . $key . '%');
        return $this->applyBeforeExecuteQuery($data)->get();
    }

    /**
     * @param $charge_code
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function getDetailByItemNumber($charge_code)
    {
        // TODO: Implement getDetailByChargeCode() method.
        $data = $this->model->select('*')
            ->where('charge_code.charge_code', '=', $charge_code);
        return $this->applyBeforeExecuteQuery($data)->first();
    }
}
