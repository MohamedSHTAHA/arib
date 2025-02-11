<?php

namespace App\Http\Requests\Department;

use App\Http\Requests\BaseRequest;

class StoreDepartmentRequest extends BaseRequest
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
        ];
    }
}
