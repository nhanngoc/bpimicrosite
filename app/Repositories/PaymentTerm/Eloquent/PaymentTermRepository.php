<?php

namespace App\Repositories\PaymentTerm\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\PaymentTerm\Interfaces\PaymentTermInterface;

class PaymentTermRepository extends RepositoriesAbstract implements PaymentTermInterface
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
        $data = $this->model->select([DB::raw('payment_term AS title'), 'payment_term'])->get()->toArray();
        $list = array_column($data, 'title', 'payment_term');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
