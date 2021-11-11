<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class CourseDetailResource extends JsonResource
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
            "id" => $this->id_kursus,
            "name" => $this->nama_kursus,
            "image" => Helper::getFile('kursus', $this->foto_kursus),
            "membership" => $this->paket->id_paket,
            "description" => $this->deskripsi
        ];
    }
}
