<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;
use App\Http\Resources\PillarResource;

class ClassResource extends JsonResource
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
            'id' => $this->id_kelas,
            'name' => $this->nama_kelas,
            'image' => Helper::getFile("kelas", $this->foto_kelas),
            'description' => $this->deskripsi,
            'message' => $this->pesan,
            'total_course' => count($this->kursus),
            'memberships' => $this->paket_kelas->map(function ($pk) {
                return $pk->id_paket;
            }),
            'pillars' => PillarResource::collection($this->pilar)
        ];
    }
}
