<?php

namespace App\Repositories\User\Interfaces;

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
    public function getList($prependList = [], $appendList = []);
    
    /**
     * @param string $slug
     * @return mixed
     */
    public function getUserListBySlug($slug);
}
