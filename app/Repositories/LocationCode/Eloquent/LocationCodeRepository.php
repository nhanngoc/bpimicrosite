<?php

namespace App\Repositories\LocationCode\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\LocationCode\Interfaces\LocationCodeInterface;

class LocationCodeRepository extends RepositoriesAbstract implements LocationCodeInterface
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
        $data = $this->model->select([DB::raw('CONCAT(location_code, " - ", description) AS title'), 'location_code'])->get()->toArray();
        $list = array_column($data, 'title', 'location_code');
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
    public function getIdList($prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(location_code, " - ", description) AS title'), 'id'])->get()->toArray();
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
