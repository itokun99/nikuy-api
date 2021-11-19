<?php

namespace App\Http\Resources\MyInvitation;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class EwalletResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "akun" => $this->akun,
            "qr" => Helper::getFile($this->qr),
        ];
    }
}
