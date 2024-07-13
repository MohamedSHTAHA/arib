<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\LoginEmployeeRequest;
use App\Http\Requests\Employee\StoreEmployeeRequest;
use App\Http\Requests\Employee\UpdateEmployeeRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Patterns\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeesController extends Controller
{
    function __construct(EmployeeService $service)
    {
        $this->service  = $service;
    }

    function index(Request $request)
    {

        $data = $this->service->index($request);
        return Response::apiResponse('success',  $data);
    }

    function login(LoginEmployeeRequest $request)
    {

        $data = $this->service->login($request);
        return Response::apiResponse('success',  $data);
    }

    function store(StoreEmployeeRequest $request)
    {

        $data = $this->service->create($request);
        return Response::apiResponse('success',  $data);
    }

    function update(UpdateEmployeeRequest $request, $id)
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
