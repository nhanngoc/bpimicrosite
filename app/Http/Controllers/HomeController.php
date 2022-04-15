<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Events\CreatedContentEvent;
use App\Events\UpdatedContentEvent;
use App\Http\Requests\Customer\CustomerRequest;
use App\Core\Support\Http\Responses\BaseHttpResponse;
use App\Repositories\Customer\Interfaces\CustomerInterface;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $repository;

    public function __construct(
        CustomerInterface $CustomerRepository
    ) {
        $this->repository = $CustomerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $repository = $this->repository;
        
        return view('home.index', compact('repository'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request, BaseHttpResponse $response)
    {   
        try {
            //dd($request->input());
            $customer = $this->repository->createOrUpdate(array_merge($request->input()));

            event(new CreatedContentEvent(get_class($this->repository), $request, $customer));

            return $response->setMessage(trans('notices.create_success_message'))->toResponse($request);
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
