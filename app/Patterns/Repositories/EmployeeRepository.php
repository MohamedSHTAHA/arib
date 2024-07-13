<?php

namespace App\Patterns\Repositories;

use App\Http\Resources\Employees\EmployeeResource;
use App\Models\Employee;

/**
 * Class UserRepository.
 *
 * @package namespace App\Repositories;
 */
class EmployeeRepository extends BaseRepository
{
    function __construct()
    {
        $this->makeModel();
        $this->skipPresenter(false);
        $this->setPresenter(EmployeeResource::class);
    }
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Employee::class;
    }
}
