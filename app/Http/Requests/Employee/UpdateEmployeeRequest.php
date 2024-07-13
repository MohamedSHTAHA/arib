<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $employeeId = $this->route('id');

        return [
            'first_name' => 'string|min:1',
            'last_name' => 'string|min:1',
            'salary' => 'numeric|min:1',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'manager_id' => 'exists:employees,id',
            'department_id' => 'nullable|exists:departments,id',
            'phone' => [
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:10',
                Rule::unique('employees', 'phone')->ignore($employeeId),
            ],
            'email' => [
                'email',
                Rule::unique('employees', 'email')->ignore($employeeId),
            ],
        ];
    }
}
