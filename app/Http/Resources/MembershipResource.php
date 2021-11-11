<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class MembershipResource extends JsonResource
{
    public function showPrice($price)
    {
        if ($price > 0) {
            return 'IDR ' . number_format($price, 0, ',', '.');
        } else if (!is_null($price) && $price == 0) {
            return 'FREE';
        } else {
            return NULL;
        }
    }
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
            "id" => $this->id_paket,
            "name" => $this->nama_paket,
            "description" => $this->deskripsi_paket,
            "order" => $this->order,
            "image" => Helper::getFile('paket', $this->foto_paket),
            "price" => [
                "original" => $this->harga_member
            ],
            "price_display" => [
                "original" => $this->showPrice($this->harga_member)
            ]
        ];
    }
}
