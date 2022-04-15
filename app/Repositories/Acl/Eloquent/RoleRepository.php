<?php

namespace App\Repositories\Acl\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\Acl\Interfaces\RoleInterface;
use Illuminate\Support\Str;

class RoleRepository extends RepositoriesAbstract implements RoleInterface
{
    /**
     * {@inheritdoc}
     */
    public function createSlug($name, $id)
    {
        $slug = Str::slug($name);
        $index = 1;
        $baseSlug = $slug;
        while ($this->model->where('slug', '=', $slug)->where('id', '!=', $id)->count() > 0) {
            $slug = $baseSlug . '-' . $index++;
        }

        if (empty($slug)) {
            $slug = time();
        }

        $this->resetModel();

        return $slug;
    }

    /**
     * @param array $prependList
     * @param array $appendList
     * @return array
     */
    public function getList(array $prependList = [], array $appendList = [])
    {
        $all = $this->model->select(['id', 'name'])->get()->toArray();
        $list = array_column($all, 'name', 'id');
        foreach ($list as $key => $title)
            $prependList[$key] = $title;
        foreach ($appendList as $key => $title)
            $prependList[$key] = $title;
        return $prependList;
    }

    /**
     * @param string $slug
     * @param string $company_code
     * @param double $purchaseOrderPrice
     * @return mixed
     */
    public function getUserListBySlug($slug, $company_code, $purchaseOrderPrice = 0) {
        $list = $this->model->select(['id', 'name', 'slug', 'approval_limit'])->where('slug', '=', $slug)->first();
        
        if (!$list || $list->approval_limit < $purchaseOrderPrice) {
            return [];
        }
        $userArray = $list->users->where('company_id', '=', $company_code)->pluck('email');
        return !empty($userArray) ? $userArray : [];
    }
}
