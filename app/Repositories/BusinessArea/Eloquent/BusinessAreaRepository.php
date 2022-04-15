<?php

namespace App\Repositories\BusinessArea\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\BusinessArea\Interfaces\BusinessAreaInterface;

class BusinessAreaRepository extends RepositoriesAbstract implements BusinessAreaInterface
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
        $data = $this->model->select([DB::raw('CONCAT(business_area_code, " - ", description) AS title'), 'business_area_code'])->get()->toArray();
        $list = array_column($data, 'title', 'business_area_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
