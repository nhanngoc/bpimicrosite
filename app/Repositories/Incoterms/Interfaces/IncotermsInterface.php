<?php

namespace App\Repositories\Incoterms\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface IncotermsInterface extends RepositoryInterface
{
/**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());
}

