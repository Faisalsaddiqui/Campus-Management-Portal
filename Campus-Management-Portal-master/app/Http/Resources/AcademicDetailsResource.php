<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademicDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return  [
            'id' => $this->id,
            'type' => $this->type,
            'title' => $this->title,
            'exam_type' => $this->exam_type,
            'reg_no' => $this->reg_no,
            'passing_year' => $this->passing_year,
            'organization' => $this->whenLoaded('organization'),
            'obtained_marks' => $this->obtained_marks,
            'total_marks' => $this->total_marks,
            'image' =>  $this->media ? $this->media->baseMedia->getUrl() : null,
        ];
    }
}
