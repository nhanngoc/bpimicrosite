<?php

namespace App\Http\Controllers;

use App\Models\CompanyCode;
use Illuminate\Http\Request;
use App\Events\CreatedContentEvent;
use App\Events\DeletedContentEvent;
use App\Events\UpdatedContentEvent;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyCode\CompanyCodeRequest;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Models\Department;
use App\Repositories\CompanyCode\Interfaces\CompanyCodeInterface;
use App\Services\CompanyCode\CreateCompanyCodeService;

class CompanyCodeController extends Controller
{
    protected $repository;

    public function __construct(
        CompanyCodeInterface $companyCodeRepository
    )
    {
        $this->repository = $companyCodeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $data = $this->repository->all();
        return view('company-code.index', compact('data'));
    }

    public function getAll()
    {
        $posts = CompanyCode::all();
        return response()->json($posts);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $repository = $this->repository;
        $departments = Department::all()->pluck('name', 'id')->toArray();
        return view('company-code.create', compact('repository', 'departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CompanyCodeRequest $request
     * @param BaseHttpResponse $response
     * @return BaseHttpResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(CompanyCodeRequest $request, BaseHttpResponse $response, CreateCompanyCodeService $service)
    {
        try {
            /**
             * @var CompanyCode $record
             */
            $companyCode = $this->repository->createOrUpdate(array_merge($request->input(), [
                'author_id'   => Auth::id(),
                'author_type' => User::class,
            ]));

            $service->execute($request, $companyCode);

            event(new CreatedContentEvent(get_class($this->repository), $request, $companyCode));

            return $response->setNextUrl(route('company-code.index'))->setMessage(trans('notices.create_success_message'))->toResponse($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param CompanyCode $customerVendor
     */
    public function show(CompanyCode $companyCode)
    {
        //
    }

    /**
     * @param CompanyCode $companyCode
     */
    public function edit(CompanyCode $companyCode)
    {
        $departments = Department::all()->pluck('name', 'id')->toArray();

        return view('company-code.edit', compact('companyCode', 'departments'));
    }

    /**
     * @param CompanyCodeRequest $request
     * @param CompanyCode $companyCode
     * @param BaseHttpResponse $response
     */
    public function update(
        CompanyCodeRequest $request,
        CompanyCode $companyCode,
        BaseHttpResponse $response,
        CreateCompanyCodeService $service
    )
    {
        //
        try {
            $companyCode->fill($request->input());
            $this->repository->createOrUpdate($companyCode);
            event(new UpdatedContentEvent(get_class($this->repository), $request, $companyCode));
            
            $service->execute($request, $companyCode);
            return $response->setPreviousUrl(route('company-code.index'))->setNextUrl(route('company-code.edit', $companyCode->id))
                ->setMessage(trans('notices.update_success_message'))
                ->toResponse($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * @param Request $request
     * @param CompanyCode $record
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id, BaseHttpResponse $response)
    {
        //

        try {
            $companyCode = $this->repository->findOrFail($id);
            $this->repository->delete($companyCode);
            event(new DeletedContentEvent(get_class($this->repository->getModel()), $request, $companyCode));
            return response()->json([
                'msg'    => trans('notices.delete_success_message'),
                'status' => 200
            ], 200);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function getDepartmentByCompanyId($id)
    {
        $data = CompanyCode::where(['code' => $id])->firstOrFail();
        if (!$data) {
           return [];
        }
        return response()->json($data->departments->all());
    }
}
