<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class LocationResource extends JsonResource
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
            "province" => [
                "id" => $this->province->prov_id,
                "name" => Str::title($this->province->prov_name),
            ],
            "city" => [
                "id" => $this->city->city_id,
                "name" => Str::title($this->city->city_name),
            ],
            "district" => [
                "id" => $this->district->dis_id,
                "name" => Str::title($this->district->dis_name),
            ],
            "subdistrict" => [
                "id" => $this->subdistrict->subdis_id,
                "name" => Str::title($this->subdistrict->subdis_name),
            ],
            "postal_code" => $this->postal_code,
            "address" => $this->address,
            "googlemap" => $this->googlemap
        ];
    }
}
