<?php

namespace App\Http\Requests\Employee;

use App\Http\Requests\BaseRequest;

class StoreEmployeeRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'first_name' => 'required|string|min:1',
            'last_name' => 'required|string|min:1',
            'salary' => 'required|numeric|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'department_id' => 'nullable|exists:departments,id',
            // 'manager_id' => 'required|exists:employees,id',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:employees,phone',
            'email' => 'required|email|unique:employees,email',
            'password' => [
                'required',
                'string',
                'min:8',              // Minimum length of 8 characters
                'regex:/[a-z]/',      // At least one lowercase letter
                'regex:/[A-Z]/',      // At least one uppercase letter
                'regex:/[0-9]/',      // At least one digit
                'regex:/[@$!%*?&#]/', // At least one special character
            ],
        ];
    }
}
