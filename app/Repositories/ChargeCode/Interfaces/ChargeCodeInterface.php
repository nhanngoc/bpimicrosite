<?php

namespace App\Repositories\ChargeCode\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface ChargeCodeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());

    /**
     * @param $key
     * @return mixed
     */
    public function getSearchChargeCode($key);

    /**
     * @param $charge_code
     * @return mixed
     */
    public function getDetailByChargeCode($charge_code);
}

