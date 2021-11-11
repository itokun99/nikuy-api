<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class BannerKelasResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->judul,
            'image' => Helper::getFile('banner', $this->gambar),
            'order' => $this->order,
            'class' => [
                'id' => $this->kelas->id_kelas,
                'name' => $this->kelas->nama_kelas,
                'image' => Helper::getFile('kelas', $this->kelas->foto_kelas),
                'memberships' => $this->kelas->paket_kelas->map(function ($paket_kelas) {
                    return $paket_kelas->id_paket;
                })
            ],
            'items' => $this->items->map(function ($item) {
                return [
                    'id' => $item->kursus->id_kursus,
                    'name' => $item->kursus->nama_kursus,
                    'image' => Helper::getFile('kursus', $item->kursus->foto_kursus),
                    'pillar' => $item->kursus->pilar->id_pilar,
                    'membership' => $item->kursus->paket ? [
                        "id" => $item->kursus->paket->id_paket,
                        "order" => $item->kursus->paket->order
                    ] : NULL
                ];
            })
        ];
    }
}
