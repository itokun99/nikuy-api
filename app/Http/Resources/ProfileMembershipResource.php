<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileMembershipResource extends JsonResource
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

        if (!$this || !$this->paket) {
            return NULL;
        }

        return [
            "id" => $this->paket->id_paket,
            "name" => $this->paket->nama_paket,
            "image" => Helper::getFile('paket', $this->paket->foto_paket),
            "order" => $this->paket->order,
            "subscribe_at" => $this->subscribe_at,
            "expired_at" => $this->expired_at
        ];
    }
}
