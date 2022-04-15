<?php

namespace App\Repositories\BusinessType\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface BusinessTypeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());


    /**
     * @param array $prependList
     * @param array $appendList
     * @param string $company_code
     * @return mixed
     */
    public function getListByCode($prependList = array(), $appendList = array(), $company_code);
}
