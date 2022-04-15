<?php

namespace App\Repositories\RegionCode\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\RegionCode\Interfaces\RegionCodeInterface;
use Illuminate\Support\Facades\DB;

class RegionCodeRepository extends RepositoriesAbstract implements RegionCodeInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        $data = $this->model->select([DB::raw('region_code AS name'), 'region_code'])->get()->toArray();
        $list = array_column($data, 'name', 'region_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
