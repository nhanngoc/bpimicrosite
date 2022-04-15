<?php

namespace App\Repositories\CargoType\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Repositories\CargoType\Interfaces\CargoTypeInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class CargoTypeRepository extends RepositoriesAbstract implements CargoTypeInterface
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
        $data = $this->model->select([DB::raw('CONCAT(cargo_type, " - ", description) AS title'), 'cargo_type'])->get()->toArray();
        $list = array_column($data, 'title', 'cargo_type');
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
        $data = $this->model->select([DB::raw('CONCAT(cargo_type, " - ", description) AS title'), 'id'])->get()->toArray();
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
