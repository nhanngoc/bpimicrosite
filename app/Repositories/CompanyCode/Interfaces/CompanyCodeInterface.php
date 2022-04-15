<?php

namespace App\Repositories\CompanyCode\Interfaces;


use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface CompanyCodeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());

    /**
     * @param $code
     * @return mixed
     */
    public function getByCode($code);
}
