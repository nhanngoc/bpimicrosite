<?php

namespace App\Repositories\Acl\Interfaces;


use App\Core\Support\Repositories\Interfaces\RepositoryInterface;

interface RoleInterface extends RepositoryInterface
{
    /**
     * @param string $name
     * @param int|null $id
     * @return string
     */
    public function createSlug($name, $id);

    /**
     * @param array $prependList
     * @param array $appendList
     * @return mixed
     */
    public function getList(array $prependList = [], array $appendList = []);

    /**
     * @param string $slug
     * @param string $company_code
     * @param double $purchaseOrderPrice
     * @return mixed
     */
    public function getUserListBySlug($slug, $company_code, $purchaseOrderPrice);
}
