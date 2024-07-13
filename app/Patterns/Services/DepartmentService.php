<?php

namespace App\Patterns\Services;

use App\Exceptions\GeneralException;
use App\Models\Department;
use App\Patterns\Repositories\DepartmentRepository;

/**
 * Class UserService
 *
 *
 */
class DepartmentService extends BaseService
{

    function __construct(DepartmentRepository $repository)
    {
        $this->repository  = $repository;
    }

    function index($request)
    {
        return  $this->repository
            ->whereQuery(function ($query) use ($request) {
                return $query
                    ->when($request->has('name'), fn ($q) => $q->where('name', 'like', "%{$request->name}%"));
            })
            ->withCount([
                'members'
            ])

            ->withSum('members', 'salary')

            ->paginate();
    }

    function create($request)
    {
        //TODO:Can be use DTO PATTERN
        $data = $request->validated();

        $employee = $this->repository->create($data);

        return $employee;
    }

    function update($request, $id)
    {
        //TODO:Can be use DTO PATTERN

        $data = $request->validated();

        $department = $this->repository->update($data, $id);

        return $department;
    }

    function delete($id)
    {
        $department = $this->repository->withCount(['members'])->find($id);
        if ($department->members_count > 0) {
            throw new GeneralException(
                'Cannot delete department. There are employees in this department.',
                422
            );
        }
        return $department->delete($id);
    }
}
