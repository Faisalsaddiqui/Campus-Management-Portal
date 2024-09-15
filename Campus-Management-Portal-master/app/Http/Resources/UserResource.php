<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'avatar' => $this->avatar,
            'father_name' => $this->father_name,
            'cnic' => $this->cnic,
            'gender' => $this->gender,
            'date_of_birth' => $this->date_of_birth,
            'age' => Carbon::parse($this->date_of_birth)->age,
            'enrollments' => new EnrollmentCollection($this->whenLoaded('enrollments')),
            'academicDetails' => AcademicDetailsResource::collection($this->whenLoaded('academicDetails')),

            'roles' => $this->whenLoaded('roles', function () {
                return $this->roles->pluck('name');
            }),
        ];
    }
}
