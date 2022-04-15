<?php

namespace App\Repositories\User\Eloquent;


use App\Core\Support\Repositories\Eloquent\RepositoriesAbstract;
use App\Repositories\User\Interfaces\RoleInterface;
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
     * @return array|mixed
     */
    public function getList($prependList = [], $appendList = [])
    {
        $list = $this->pluck('name', 'id');
        foreach ($list as $key => $title) {
            $prependList[$key] = $title;
        }
        foreach ($appendList as $key => $title) {
            $prependList[$key] = $title;
        }
        return $prependList;
    }

    /**
     * @param string $slug
     * @return mixed
     */
    public function getUserListBySlug($slug) {
        $list = $this->model->select(['id', 'name', 'slug'])->where('slug', '=', $slug)->first();
        if (!$list) {
            return [];
        }
        $userArray = $list->users->pluck('email');
        return !empty($userArray) ? $userArray : [];
    }
}
