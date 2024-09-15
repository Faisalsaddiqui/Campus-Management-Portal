<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return
            [
                'id' => $this->id,
                'program_name' => $this->full_program_name,
                'degree' => new DegreeResource($this->whenLoaded('degree')),
                'department' => new DepartmentResource($this->whenLoaded('department')),
                'credit_hours' => $this->credit_hours,
                'evening_option' => $this->evening_option,
                'morning_option' =>  $this->morning_option,
                'slug' => $this->slug
            ];
    }
}
