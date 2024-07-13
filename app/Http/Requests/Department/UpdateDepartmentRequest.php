<?php

namespace App\Http\Requests\Department;

use App\Http\Requests\BaseRequest;
use Illuminate\Validation\Rule;

class UpdateDepartmentRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'string|min:1',
        ];
    }
}
