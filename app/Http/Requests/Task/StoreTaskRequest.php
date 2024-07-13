<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\BaseRequest;

class StoreTaskRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|string|min:1',
            'employee_id' => 'required|exists:employees,id,manager_id,'.auth('employee_api')->user()->id,
        ];
    }
}
