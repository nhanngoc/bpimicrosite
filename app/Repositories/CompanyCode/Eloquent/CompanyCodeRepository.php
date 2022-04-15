<?php

namespace App\Repositories\CompanyCode\Eloquent;

use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\CompanyCode\Interfaces\CompanyCodeInterface;
use Illuminate\Support\Facades\DB;

class CompanyCodeRepository extends RepositoriesAbstract implements CompanyCodeInterface
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
        $data = $this->model->select([DB::raw('CONCAT(code, " - ", name) AS title'), 'code'])->get()->toArray();
        $list = array_column($data, 'title', 'code');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }

    /**
     * @param $code
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Query\Builder|mixed|object|null
     */
    public function getByCode($code)
    {
        $data = $this->model->where('code', $code);
        return $this->applyBeforeExecuteQuery($data)->first();
    }
}
