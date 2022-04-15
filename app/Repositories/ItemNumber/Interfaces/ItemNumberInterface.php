<?php

namespace App\Repositories\ItemNumber\Interfaces;


use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface ItemNumberInterface extends RepositoryInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @param string $type
     * @return mixed
     */
    public function getListByType($prependList = array(), $appendList = array(),$type = "SO");

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

    /**
     * @param $key
     * @return mixed
     */
    public function getSearchItemNumber($key);

    /**
     * @param $charge_code
     * @return mixed
     */
    public function getDetailByItemNumber($charge_code);

    /**
     * GetList For Select
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getListByMaterialCode($material_code, $company_code, $prependList = array(), $appendList = array());
    /**
     * GetList For Select By company code
     *
     * @param string $companyCode
     * @param array $prependList
     * @param array $appendList
     * @param string $type SO or PO (default PO)
     * @return array|mixed
     */
    public function getListByCompanyCode($companyCode, $prependList = array(), $appendList = array(), $type = 'PO');
    /**
     * GetList For Select By company code
     * @param array $purchaseOrderItems
     * @param string $companyCode
     * @param array $prependList
     * @param array $appendList
     * @param string $type SO or PO (default PO)
     * @return array|mixed
     */
    public function getListByPOItems($purchaseOrderItems, $companyCode, $prependList = array(), $appendList = array(), $type = 'PO');
}
