<?php

namespace App\Repositories\ItemNumber\Caches;

use App\Core\Support\Repositories\Caches\CacheAbstractDecorator;
use App\Repositories\ItemNumber\Interfaces\ItemNumberInterface;

class ItemNumberCacheDecorator extends CacheAbstractDecorator implements ItemNumberInterface
{
    /**
     * @param array $prependList
     * @param array $appendList
     * @param string $type
     * @return mixed|void
     */
    public function getListByType($prependList = array(), $appendList = array(), $type = "SO")
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList($prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * GetList For Select by company code
     *
     * @param string $companyCode
     * @param array $prependList
     * @param array $appendList
     * @param string $type SO or PO (default PO)
     * @return array|mixed
     */
    public function getListByCompanyCode($companyCode, $prependList = array(), $appendList = array(), $type = 'PO')
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
    /**
     * GetList For Select by company code
     *
     * @param string $companyCode
     * @param array $prependList
     * @param array $appendList
     * @param string $type SO or PO (default PO)
     * @return array|mixed
     */
    public function getListByPOItems($purchaseOrderItems, $companyCode, $prependList = array(), $appendList = array(), $type = 'PO')
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
    
    /**
     * @param $code
     * @return mixed
     */
    public function getByCode($code)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * @param $key
     * @return mixed
     */
    public function getSearchItemNumber($key)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /**
     * @param $charge_code
     * @return mixed
     */
    public function getDetailByItemNumber($charge_code)
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }

    /** GetList For Select
     *
     * @param array $prependList
     * @param array $appendList
     * @return array|mixed
     */
    public function getListByMaterialCode($material_code, $company_code, $prependList = array(), $appendList = array())
    {
        return $this->flushCacheAndUpdateData(__FUNCTION__, func_get_args());
    }
}
