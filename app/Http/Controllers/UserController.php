<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use App\Models\Department;
use App\Models\CompanyCode;
use Illuminate\Http\Request;
use App\Events\DeletedContentEvent;
use App\Events\Role\RoleAssignmentEvent;
use App\Services\User\CreateUserService;
use App\Http\Requests\User\EditUserRequest;
use App\Http\Requests\User\CreateUserRequest;
use App\Repositories\Acl\Eloquent\RoleRepository;
use App\Repositories\Acl\Interfaces\RoleInterface;
use App\Repositories\Acl\Interfaces\UserInterface;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Repositories\CompanyCode\Interfaces\CompanyCodeInterface;

class UserController extends Controller
{
    /**
     * @var UserInterface
     */
    protected $userRepository;
    /**
     * @var RoleRepository
     */
    protected $roleRepository;
    /**
     * @var string
     */
    protected $redirectTo;

    public function __construct(UserInterface $userRepository, RoleInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $users = $this->userRepository->all();
        return view('users.index', compact('users'));
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = $this->userRepository;
        $roles = $this->roleRepository->getList([
            '' => 'Select role'
        ], []);
        
        return view('users.create', compact('user', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateUserRequest $request
     * @param CreateUserService $service
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse
     */
    public function store(CreateUserRequest $request, CreateUserService $service, BaseHttpResponse $response)
    {
        try {
            $service->execute($request);
            return $response->setPreviousUrl(route('users.index'))->setMessage(trans('notices.create_success_message'));

        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $user = $this->userRepository->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $user = $this->userRepository->findOrFail($id);
        $roles = $this->roleRepository->getList([
            '' => 'Select role'
        ], []);
        
        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update User
     *
     * @param Request $request
     * @param $id
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(EditUserRequest $request, $id, BaseHttpResponse $response)
    {
        try {

            $user = $this->userRepository->findById($id);
            $user->fill($request->input());
            $this->userRepository->createOrUpdate($user);
            if ($request->input('role_id')) {
                $role = $this->roleRepository->getFirstBy([
                    'id' => $request->input('role_id'),
                ]);

                if (!empty($role)) {
                    $oldRole = $user->roles->first();
                    $user->roles()->detach($oldRole->id);
                    $role->users()->attach($user->id);
                    event(new RoleAssignmentEvent($role, $user));
                }
            }
            return $response->setPreviousUrl(route('users.index'))->setNextUrl(route('users.edit', $id))
                ->setMessage(trans('notices.update_success_message'))
                ->toResponse($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $id
     * @param BaseHttpResponse $response
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        //

        try {
            $user = $this->userRepository->findOrFail($id);
            $this->userRepository->delete($user);
            event(new DeletedContentEvent(get_class($this->userRepository->getModel()), $request, $user));
            return response()->json([
                'msg'    => trans('notices.delete_success_message'),
                'status' => 200
            ], 200);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }


}
