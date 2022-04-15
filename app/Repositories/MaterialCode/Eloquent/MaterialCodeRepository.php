<?php

namespace App\Repositories\MaterialCode\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\MaterialCode\Interfaces\MaterialCodeInterface;
use Illuminate\Support\Facades\DB;

class MaterialCodeRepository extends RepositoriesAbstract implements MaterialCodeInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed|void
     */
    public function getList($prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(material_code, " - ", description) AS title'), 'material_code'])->get()->toArray();
        $list = array_column($data, 'title', 'material_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
