<?php

namespace App\Repositories\PurchasingDocType\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface PurchasingDocTypeInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($type, $prependList = array(), $appendList = array());
}
