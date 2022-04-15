<?php

namespace App\Repositories\UOM\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Repositories\UOM\Interfaces\UOMInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class UOMRepository extends RepositoriesAbstract implements UOMInterface
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
        $data = $this->model->select([DB::raw('CONCAT(uom_code, " - ", uom_text) AS title'), 'uom_code'])->get()->toArray();
        $list = array_column($data, 'title', 'uom_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
