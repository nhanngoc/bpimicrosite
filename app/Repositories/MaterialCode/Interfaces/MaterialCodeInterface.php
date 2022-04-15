<?php

namespace App\Repositories\MaterialCode\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface MaterialCodeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());

}

