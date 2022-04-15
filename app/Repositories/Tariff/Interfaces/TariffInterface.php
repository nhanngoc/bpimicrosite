<?php

namespace App\Repositories\Tariff\Interfaces;

use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface TariffInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array());

    /**
     * @param CustomerVendor $vendor
     * @param ItemNumber $itemNumber
     * @return float
     */
    public function getPriceByTariff($vendor, $itemNumber);
}
