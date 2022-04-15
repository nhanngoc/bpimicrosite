<?php

namespace App\Repositories\Customer\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\Customer\Interfaces\CustomerInterface;

class CustomerRepository extends RepositoriesAbstract implements CustomerInterface
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
        $data = $this->model->select([DB::raw('CONCAT(first_name, " - ", last_name) AS title'), 'first_name'])->get()->toArray();
        $list = array_column($data, 'title', 'first_name');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
