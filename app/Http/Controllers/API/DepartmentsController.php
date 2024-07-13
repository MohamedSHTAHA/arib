<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Department\StoreDepartmentRequest;
use App\Http\Requests\Department\UpdateDepartmentRequest;
use App\Patterns\Services\DepartmentService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DepartmentsController extends Controller
{
    function __construct(DepartmentService $service)
    {
        $this->service  = $service;
    }

    function index(Request $request)
    {

        $data = $this->service->index($request);
        return Response::apiResponse('success',  $data);
    }


    function store(StoreDepartmentRequest $request)
    {

        $data = $this->service->create($request);
        return Response::apiResponse('success',  $data);
    }

    function update(UpdateDepartmentRequest $request, $id)
    {

        $data = $this->service->update($request, $id);
        return Response::apiResponse('success',  $data);
    }


    function destroy($id)
    {
        $this->service->delete($id);
        return Response::apiResponse('success');
    }
}
