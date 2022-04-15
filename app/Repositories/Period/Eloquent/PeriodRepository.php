<?php

namespace App\Repositories\Period\Eloquent;

use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\Period\Interfaces\PeriodInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PeriodRepository extends RepositoriesAbstract implements PeriodInterface
{
    /**
     * @param bool $hasCondition
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($prependList = array(), $appendList = array(), $hasCondition = false)
    {
        $data = $this->model;
        if ($hasCondition) {
            $data = $data->whereMonth('starting_date', '>=', Carbon::today()->format('m'))
                ->whereYear('starting_date', '=', Carbon::today()->format('Y'));
        }
        $data = $data->select([DB::raw('period AS title'), 'period'])->get()->toArray();
        $list = array_column($data, 'title', 'period');

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
        $data = $this->model->where('period', $code);
        return $this->applyBeforeExecuteQuery($data)->first();
    }
}
