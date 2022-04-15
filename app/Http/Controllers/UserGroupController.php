<?php

namespace App\Http\Controllers;

use App\Models\UserGroup;
use Illuminate\Http\Request;
use App\Events\CreatedContentEvent;
use App\Events\DeletedContentEvent;
use App\Events\UpdatedContentEvent;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\UserGroup\UserGroupRequest;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Repositories\UserGroup\Interfaces\UserGroupInterface;

class UserGroupController extends Controller
{
    protected $repository;

    public function __construct(
        UserGroupInterface $userGroupRepository
    )
    {
        $this->repository = $userGroupRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->repository->all();
        return view('users.user-group.index', compact('data'));
    }

    public function getAll()
    {
        $posts = UserGroup::all();
        return response()->json($posts);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $repository = $this->repository;
        return view('users.user-group.create', compact('repository'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserGroupRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(UserGroupRequest $request, BaseHttpResponse $response)
    {
        try {
            /**
             * @var UserGroup $record
             */
            $userGroup = $this->repository->createOrUpdate(array_merge($request->input(), [
                'author_id'   => Auth::id(),
                'author_type' => User::class,
            ]));

            event(new CreatedContentEvent(get_class($this->repository), $request, $userGroup));

            return $response->setNextUrl(route('user-group.index'))->setMessage(trans('notices.create_success_message'))->toResponse($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param UserGroup $customerVendor
     */
    public function show(UserGroup $userGroup)
    {
        //
    }

    /**
     * @param UserGroup $userGroup
     */
    public function edit(UserGroup $userGroup)
    {
        
        return view('users.user-group.edit', compact('userGroup'));
    }

    /**
     * @param UserGroupRequest $request
     * @param UserGroup $userGroup
     * @param BaseHttpResponse $response
     */
    public function update(
        UserGroupRequest $request,
        UserGroup $userGroup,
        BaseHttpResponse $response
    )
    {
        //
        try {
            $userGroup->fill($request->input());
            $this->repository->createOrUpdate($userGroup);
            event(new UpdatedContentEvent(get_class($this->repository), $request, $userGroup));
            
            return $response->setPreviousUrl(route('user-group.index'))->setNextUrl(route('user-group.edit', $userGroup->id))
                ->setMessage(trans('notices.update_success_message'))
                ->toResponse($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param Request $request
     * @param UserGroup $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        //

        try {
            $userGroup = $this->repository->findOrFail($id);
            $this->repository->delete($userGroup);
            event(new DeletedContentEvent(get_class($this->repository->getModel()), $request, $userGroup));
            return response()->json([
                'msg'    => trans('notices.delete_success_message'),
                'status' => 200
            ], 200);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
