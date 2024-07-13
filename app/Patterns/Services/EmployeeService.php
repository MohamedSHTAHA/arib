<?php

namespace App\Patterns\Services;

use App\Exceptions\GeneralException;
use App\Http\Requests\Employee\LoginEmployeeRequest;
use App\Patterns\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 *
 *
 */
class EmployeeService extends BaseService
{

    function __construct(EmployeeRepository $repository)
    {
        $this->repository  = $repository;
    }

    function index($request)
    {

        return  $this->repository
            ->whereQuery(function ($query) use ($request) {
                return $query
                    ->where('manager_id', $this->loggedInUser()->id)
                    // ->when($request->has('manager_id'), fn ($q) => $q->where('manager_id', $request->manager_id))
                    ->when($request->has('name'), fn ($q) => $q->where('first_name', 'like', "%{$request->name}%")
                        ->orWhere('last_name', 'like', "%{$request->name}%"));
            })
            ->with([
                'manager',
                // 'members'
            ])
            ->paginate();
    }

    function login(LoginEmployeeRequest $request)
    {
        $employee = $this->repository->whereQuery(function ($query) use ($request) {
            return $query->where('email', $request->email_or_phone)->orWhere('phone', $request->email_or_phone);
        })->first();

        if (!$employee || !Hash::check($request->password, $employee->password)) {
            throw new GeneralException(
                'The provided credentials are incorrect.',
                401
            );
        }

        return collect($employee)->put('token', $employee->createToken('employee')->plainTextToken);
    }

    function create($request)
    {
        //TODO:Can be use DTO PATTERN
        $data = $request->validated();
        $data['manager_id'] = $this->loggedInUser()->id;


        if ($request->hasFile('image')) {
            $data['image'] = request()->file('image')->store('images', 'public');
        }

        $employee = $this->repository->with(['manager'])->create($data);

        return $employee;
    }

    function update($request, $id)
    {
        //TODO:Can be use DTO PATTERN
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $data['image'] = request()->file('image')->store('images', 'public');
        }
        $employee = $this->repository->with(['manager'])->update($data, $id);

        return $employee;
    }

    function delete($id)
    {
        return $this->repository->delete($id);
    }
}
