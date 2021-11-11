<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EventAuthorResource;
use App\Helper\Helper;

class EventResource extends JsonResource
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
        if (!$this) return NULL;

        return [
            'id' => $this->id_event,
            'name' => $this->nama_event,
            'image' => Helper::getFile('event', $this->foto_event),
            'datetime' => Helper::formatDate($this->waktu, 'l, d F Y - H:i') . " WIB",
            'venue' => $this->venue,
            'price' => [
                'original' => $this->harga_event,
                'discount' => $this->harga_diskon
            ],
            'price_display' => [
                'original' => $this->showPrice($this->harga_event),
                'discount' => $this->showPrice($this->harga_diskon)
            ],
            'author' => new EventAuthorResource($this->penulis),
        ];
    }
}
