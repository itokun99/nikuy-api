<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class CoursesResource extends JsonResource
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
            "image" => Helper::getFile('kursus', $this->kelas->foto_kursus),
            "membership" => $this->paket ? [
                "id" => $this->paket->id_paket,
                "order" => $this->paket->order
            ] : NULL,
            "complete" => count($this->proses_kursus) > 0 ? TRUE : FALSE,
        ];
    }
}
