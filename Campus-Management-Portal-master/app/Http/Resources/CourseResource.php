<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
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
            'course_name' => $this->course_name,
            'course_code' => $this->course_code,
            'department_code' => $this->department_code,
            'credit_hours' => $this->credit_hours,
            'theory_credit_hours' => $this->theory_credit_hours,
            'practical_credit_hours' => $this->practical_credit_hours,
            'semester' =>   $this->whenPivotLoaded('course_program', function () {
                return $this->pivot->semester;
            })
        ];
    }
}
