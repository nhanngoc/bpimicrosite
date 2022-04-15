<?php

namespace App\Http\Controllers;

use App\Events\DeletedContentEvent;
use App\Repositories\AuditHistory\Interfaces\AuditHistoryInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AuditHistoryController extends Controller
{
    protected $auditHistoryRepository;


    public function __construct(AuditHistoryInterface $auditHistoryRepository)
    {
        $this->auditHistoryRepository = $auditHistoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $limit = request()->input('paginate', 20);
        $histories = $this->auditHistoryRepository
            ->getModel()
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate($limit);

        return view('audit-log.index', compact('histories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $log = $this->auditHistoryRepository->findById($id);
            $this->auditHistoryRepository->delete($log);
            event(new DeletedContentEvent(get_class($this->auditHistoryRepository->getModel()), $request, $log));

            if ($request->ajax()) {
                return response()->json([
                    'msg'    => trans('notices.delete_success_message'),
                    'status' => 200
                ], 200);
            }
            return redirect()->route('admin::audit-logs.index')->with('status', trans('notices.delete_success_message'));
        } catch (\Exception $ex) {
            return response()->json([
                'msg' => $ex->getMessage(),
                'status' => $ex->getCode()
            ], $ex->getCode());
        }
    }
}
