<?php

namespace App\Repositories\TaxCode\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface TaxCodeInterface extends RepositoryInterface
{
    /**
     * @param string $type
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($type = "SO", $prependList = array(), $appendList = array());
}

