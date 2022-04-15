<?php

namespace App\Repositories\PortCode\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Repositories\PortCode\Interfaces\PortCodeInterface;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;

class PortCodeRepository extends RepositoriesAbstract implements PortCodeInterface
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
        $data = $this->model->select([DB::raw('CONCAT(port_code, " - ", description) AS title'), 'port_code'])->get()->toArray();
        $list = array_column($data, 'title', 'port_code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
