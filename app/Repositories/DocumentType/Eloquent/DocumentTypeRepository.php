<?php

namespace App\Repositories\DocumentType\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\DocumentType\Interfaces\DocumentTypeInterface;
use Illuminate\Support\Facades\DB;

class DocumentTypeRepository extends RepositoriesAbstract implements DocumentTypeInterface
{
    /**
     * Show for Select Box
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        $data = $this->model->select([DB::raw('CONCAT(document_type, " - ", description) AS title'), 'document_type'])->where('is_allow', 1)->get()->toArray();
        $list = array_column($data, 'title', 'document_type');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }
}
