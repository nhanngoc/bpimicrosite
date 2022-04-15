<?php

namespace App\Repositories\PaymentTerm\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface PaymentTermInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}
