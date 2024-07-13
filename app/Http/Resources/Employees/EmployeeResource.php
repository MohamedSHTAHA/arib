<?php

namespace App\Http\Resources\Employees;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Departments\DepartmentResource;

class EmployeeResource extends BaseResource
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
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'full_name' => $this->full_name,
            'salary' => $this->salary,
            'image' => $this->image,
            'image_url' => $this->image_url,
            'manager_id' => $this->manager_id,
            'department_id' => $this->department_id,
            'phone' => $this->phone,
            'email' => $this->email,
            'manager' => $this->whenLoaded('manager', function () {
                return new EmployeeResource($this->manager);
            }),
            'members' => $this->whenLoaded('members', function () {
                return  EmployeeResource::collection($this->members);
            }),
            'department' => $this->whenLoaded('department', function () {
                return new DepartmentResource($this->department);
            }),
        ];
    }
}
