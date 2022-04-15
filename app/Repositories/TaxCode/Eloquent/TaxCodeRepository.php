<?php

namespace App\Repositories\TaxCode\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\TaxCode\Interfaces\TaxCodeInterface;

class TaxCodeRepository extends RepositoriesAbstract implements TaxCodeInterface
{
    public function getList($type = "SO", $prependList = array(), $appendList = array())
    {
        $data = $this->model->where('type', $type)->select([\DB::raw('description AS title'), 'tax_code'])->get()->toArray();
        $list = array_column($data, 'title', 'tax_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
