<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionsResource extends JsonResource
{

    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'create' => $request->user()->can('create', $this->resource),
            'update' => $this->when(isset($this->id), function () use ($request) {
                return $request->user()->can('update', $this->resource);
            }),
            'delete' => $this->when(isset($this->id), function () use ($request) {
                return $request->user()->can('delete', $this->resource);
            }),
        ];
    }
}
