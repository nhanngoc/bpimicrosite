<?php

namespace App\Repositories\PurchasingDocType\Eloquent;


use Illuminate\Support\Facades\DB;
use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\PurchasingDocType\Interfaces\PurchasingDocTypeInterface;

class PurchasingDocTypeRepository extends RepositoriesAbstract implements PurchasingDocTypeInterface
{
    /**
     * GetList For Select
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($type, $prependList = array(), $appendList = array())
    {
        // TODO: Implement getList() method.
        $data = $this->model->select([DB::raw('CONCAT(purchasing_doc_type, " - ", description) AS title'), 'purchasing_doc_type'])
            ->where(['type' => $type])->get()->toArray();
        $list = array_column($data, 'title', 'purchasing_doc_type');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
