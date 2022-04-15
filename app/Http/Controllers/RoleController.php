<?php

namespace App\Http\Controllers;

use Artisan;
use Illuminate\Routing\Controller;
use App\Events\Role\RoleUpdateEvent;
use App\Http\Requests\Role\RoleCreateRequest;
use App\Repositories\Acl\Interfaces\RoleInterface;
use App\Repositories\Acl\Interfaces\UserInterface;

class RoleController extends Controller
{
    /**
     * @var RoleInterface
     */
    protected $roleRepository;

    /**
     * @var UserInterface
     */
    protected $userRepository;

    /**
     * RoleController constructor.
     *
     * @param RoleInterface $roleRepository
     * @param UserInterface $userRepository
     */
    public function __construct(RoleInterface $roleRepository, UserInterface $userRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $roles = $this->roleRepository->all();
        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = $this->roleRepository;
        $flags = $this->getAvailablePermissions();
        $children = $this->getPermissionTree($flags);
        $active = [];
        return view('roles.create', compact('role', 'flags', 'children', 'active'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(RoleCreateRequest $request)
    {
        try {
            $user = \Auth::user();
            $role = $this->roleRepository->createOrUpdate([
                'name'                => $request->input('name'),
                'slug'                => $this->roleRepository->createSlug($request->input('name'), 0),
                'permissions'         => $this->cleanPermission($request->input('flags')),
                'description'         => $request->input('description'),
                'approval_limit_from' => $request->input('approval_limit_from'),
                'approval_limit_to'   => $request->input('approval_limit_to'),
                'is_default'          => $request->input('is_default') !== null ? 1 : 0,
                'created_by'          => $user->id,
                'updated_by'          => $user->id,
            ]);
            if ($request->get('submit') == 'save') {
                return redirect()->route('roles.index')->with('status', trans('notices.create_success_message'));
            } else {
                return redirect()->route('roles.edit', $role->id)->with('status', trans('notices.create_success_message'));
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        //
    }

    /**
     * Return a correctly type casted permissions array
     *
     * @param array $permissions
     * @return array
     */
    protected function cleanPermission($permissions)
    {
        if (!$permissions) {
            return [];
        }

        $cleanedPermissions = [];
        foreach ($permissions as $permissionName) {
            $cleanedPermissions[$permissionName] = true;
        }

        return $cleanedPermissions;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->findOrFail($id);
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = $this->roleRepository->findOrFail($id);
        $flags = $this->getAvailablePermissions();
        $children = $this->getPermissionTree($flags);
        $active = [];
        if ($role->getModel()) {
            $active = array_keys($role->getModel()->permissions);
        }
        return view('roles.edit', compact('role', 'flags', 'children', 'active'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleCreateRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleCreateRequest $request, $id)
    {
        try {
            $role = $this->roleRepository->findOrFail($id);
            $role->name = $request->input('name');
            $role->slug = $this->roleRepository->createSlug($request->input('name'), 0);
            $role->permissions = $this->cleanPermission($request->input('flags'));
            $role->description = $request->input('description');
            $role->updated_by = auth()->user()->id;
            $role->is_default = $request->input('is_default', 0);
            $role->approval_limit_from = $request->input('approval_limit_from', 0);
            $role->approval_limit_to = $request->input('approval_limit_to', 0);
            $this->roleRepository->createOrUpdate($role);
            Artisan::call('cache:clear');

            event(new RoleUpdateEvent($role));

            if ($request->get('submit') == 'save') {
                return redirect()->route('roles.index')->with('status', trans('notices.update_success_message'));
            } else {
                return redirect()->route('roles.edit', $id)->with('status', trans('notices.update_success_message'));
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $role = $this->roleRepository->findOrFail($id);
            $role->delete();
            Artisan::call('cache:clear');
            return response()->json([
                'msg'    => trans('notices.delete_success_message'),
                'status' => 200
            ], 200);
        } catch (\Exception $ex) {
            echo $ex->getMessage();
        }
    }


    /**
     * @return array
     */
    protected function getAvailablePermissions() : array
    {
        $permissions = [];
        $configuration = config(strtolower('cms-permissions'));
        if (!empty($configuration)) {
            foreach ($configuration as $config) {
                $permissions[$config['flag']] = $config;
            }
        }

        return $permissions;
    }

    /**
     * @param int $parentId
     * @param array $allFlags
     * @return mixed
     */
    protected function getChildren($parentId, $allFlags)
    {
        $newFlagArray = [];
        foreach ($allFlags as $flagDetails) {
            if (\Arr::get($flagDetails, 'parent_flag', 'root') == $parentId) {
                $newFlagArray[] = $flagDetails['flag'];
            }
        }
        return $newFlagArray;
    }

    /**
     * @param array $permissions
     * @return array
     */
    protected function getPermissionTree($permissions) : array
    {
        $sortedFlag = $permissions;
        sort($sortedFlag);
        $children['root'] = $this->getChildren('root', $sortedFlag);

        foreach (array_keys($permissions) as $key) {
            $childrenReturned = $this->getChildren($key, $permissions);
            if (count($childrenReturned) > 0) {
                $children[$key] = $childrenReturned;
            }
        }
        return $children;
    }
}
