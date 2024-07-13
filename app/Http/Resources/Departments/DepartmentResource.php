<?php

namespace App\Http\Resources\Departments;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Employees\EmployeeResource;

class DepartmentResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            // 'resource' => $this->resource,
            'id' => $this->id,
            'name' => $this->name,
            'members' => $this->whenLoaded('members', function () {
                return  EmployeeResource::collection($this->members);
            }),
            'members_count' => $this->when($this->members_count !== null, $this->members_count, 0),
            'members_sum_salary' => $this->when($this->members_sum_salary !== null, $this->members_sum_salary, 0),


        ];
    }
}
