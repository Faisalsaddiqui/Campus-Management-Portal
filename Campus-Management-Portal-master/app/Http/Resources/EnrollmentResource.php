<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EnrollmentResource extends JsonResource
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
            'session_type' => $this->session_type,
            'registration_number' => $this->registration_number,
            'session_start' => $this->session_start,
            'program' => new ProgramResource($this->whenLoaded('program')),
        ];
    }
}
