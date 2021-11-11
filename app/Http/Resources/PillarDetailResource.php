<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PillarDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            "id" => $this->id_pilar,
            "name" => $this->nama_pilar,
            "courses" => CoursesResource::collection($this->kursus),
            "description" => $this->desk_pilar
        ];
    }
}
