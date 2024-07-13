<?php

namespace App\Http\Resources\Tasks;

use App\Http\Resources\BaseResource;
use App\Http\Resources\Employees\EmployeeResource;

class TaskResource extends BaseResource
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
            'name' => $this->name,
            'status' => $this->status,
            'employee_id' => $this->employee_id,
            'employee' => $this->whenLoaded('employee', function () {
                return new EmployeeResource($this->employee);
            })
        ];
    }
}
