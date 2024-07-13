<?php

namespace App\Patterns\Services;

use App\Exceptions\GeneralException;

/**
 * Class BaseService
 *
 *
 */
abstract class BaseService implements ServiceInterface
{
    public $employee;
    function loggedInUser()
    {

        $this->employee = auth('employee_api')->user();
        if ($this->employee)
            return  $this->employee;

        throw new GeneralException(
            'The provided credentials are incorrect.',
            401
        );
    }
}
