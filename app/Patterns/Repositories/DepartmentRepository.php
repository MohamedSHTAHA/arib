<?php

namespace App\Patterns\Repositories;

use App\Http\Resources\Departments\DepartmentResource;
use App\Models\Department;

/**
 * Class UserRepository.
 *
 * @package namespace App\Repositories;
 */
class DepartmentRepository extends BaseRepository
{
    function __construct()
    {
        $this->makeModel();
        $this->skipPresenter(false);
        $this->setPresenter(DepartmentResource::class);
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Department::class;
    }
}
