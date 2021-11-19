<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class CoupleResource extends JsonResource
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
            "description" => $this->description,
            "photo" => Helper::getFile($this->photo)
        ];
    }
}
