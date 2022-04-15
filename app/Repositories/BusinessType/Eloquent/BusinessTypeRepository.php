<?php

namespace App\Repositories\BusinessType\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\BusinessType\Interfaces\BusinessTypeInterface;

class BusinessTypeRepository extends RepositoriesAbstract implements BusinessTypeInterface
{
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
        $data = $this->model->select([DB::raw('CONCAT(business_type, " - ", description) AS title'), 'business_type'])->get()->toArray();
        $list = array_column($data, 'title', 'business_type');
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
    public function getListByCode($prependList = array(), $appendList = array(), $company_code)
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(business_type, " - ", description) AS title'), 'business_type'])
            ->where(['company_code' => $company_code])->get()->toArray();
        $list = array_column($data, 'title', 'business_type');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
