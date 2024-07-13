<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Patterns\Services\TaskService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TasksController extends Controller
{
    function __construct(TaskService $service)
    {
        $this->service  = $service;
    }

    function index(Request $request)
    {
        $data = $this->service->index($request);
        return Response::apiResponse('success',  $data);
    }

    function store(StoreTaskRequest $request)
    {

        $data = $this->service->create($request);
        return Response::apiResponse('success',  $data);
    }

    function update(UpdateTaskRequest $request, $id)
    {

        $data = $this->service->update($request, $id);
        return Response::apiResponse('success',  $data);
    }



}
