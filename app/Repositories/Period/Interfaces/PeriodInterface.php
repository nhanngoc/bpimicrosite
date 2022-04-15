<?php

namespace App\Repositories\Period\Interfaces;


use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface PeriodInterface extends RepositoryInterface
{
    /**
     * @param bool $hasCondition
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array(), $hasCondition = false);

    /**
     * @param $code
     * @return mixed
     */
    public function getByCode($code);
}
