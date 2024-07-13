<?php

namespace App\Patterns\Services;

use App\Exceptions\GeneralException;
use App\Http\Requests\Employee\LoginEmployeeRequest;
use App\Patterns\Repositories\EmployeeRepository;
use App\Patterns\Repositories\TaskRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 *
 *
 */
class TaskService extends BaseService
{

    function __construct(TaskRepository $repository)
    {
        $this->repository  = $repository;
    }

    function index($request)
    {

        return  $this->repository
            ->whereQuery(function ($query) use ($request) {
                return $query
                    ->whereHas('employee', function ($query) {
                        $query->where('manager_id', $this->loggedInUser()->id);
                    })
                    ->when($request->has('name'), fn ($q) => $q->where('name', 'like', "%{$request->name}%"))
                    ->when($request->has('status'), fn ($q) => $q->where('status', 'like', "%{$request->status}%"))
                    ->when($request->has('employee_id'), fn ($q) => $q->where('employee_id', 'like', "%{$request->employee_id}%"));
            })
            ->paginate();
    }



    function create($request)
    {
        //TODO:Can be use DTO PATTERN
        $data = $request->validated();

        $task = $this->repository->with(['manager'])->create($data);

        return $task;
    }

    function update($request, $id)
    {
        //TODO:Can be use DTO PATTERN
        $data = $request->validated();

        $task = $this->repository
            ->whereQuery(function ($query) use ($request) {
                return $query
                    ->whereHas('employee', function ($query) {
                        $query->where('manager_id', $this->loggedInUser()->id);
                    });
            })
            ->update($data, $id);

        return $task;
    }
}
