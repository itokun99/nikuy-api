<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileLocationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "province" => $this->province,
            "city" => $this->city,
            "district" => $this->district,
            "subdistrict" => $this->subdistrict,
            "address" => $this->address,
            "postal_code" => $this->postal_code
        ];
    }
}
