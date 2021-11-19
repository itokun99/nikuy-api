<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "location" => $this->location,
            "date" => $this->date,
            "start" => $this->start,
            "end" => $this->end
        ];
    }
}
