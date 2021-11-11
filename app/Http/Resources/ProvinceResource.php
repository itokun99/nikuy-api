<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProvinceResource extends JsonResource
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
        if (!$this) {
            return NULL;
        }

        return [
            'id' => $this->id_provinsi,
            'name' => $this->nama_provinsi
        ];
    }
}
