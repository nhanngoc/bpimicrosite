<?php

namespace App\Repositories\Incoterms\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Repositories\Incoterms\Interfaces\IncotermsInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class IncotermsRepository extends RepositoriesAbstract implements IncotermsInterface
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
        $data = $this->model->select([DB::raw('CONCAT(incoterms, " - ", description) AS title'), 'incoterms'])->get()->toArray();
        $list = array_column($data, 'title', 'incoterms');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
