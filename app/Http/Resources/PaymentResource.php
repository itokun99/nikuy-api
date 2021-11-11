<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\BankResource;

class PaymentResource extends JsonResource
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
            "id" => $this->id,
            "bank" => new BankResource($this->bank),
            "number" => $this->rekening,
            "owner" => $this->pemilik,
            "type" => $this->tipe,
            "description" => $this->deskripsi
        ];
    }
}
