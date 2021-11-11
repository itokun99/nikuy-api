<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;
use App\Http\Resources\EventResource;
use App\Http\Resources\MembershipResource;

class TransactionResource extends JsonResource
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
            "id" => $this->id_transaksi,
            "name" => $this->nama_transaksi,
            "bank" => $this->bank_asal,
            "account_number" => $this->no_rek,
            "account_owner" => $this->nama_rekening,
            "evidence" => Helper::getFile("transaksi", $this->foto_struk),
            "nominal" => $this->biaya_transaksi,
            "nominal_display" => Helper::showPrice($this->biaya_transaksi),
            "status" => $this->keterangan,
            "message" => $this->pesan,
            "event" => new EventResource($this->event),
            "membership" => new MembershipResource($this->paket),
            "created_at" => Helper::formatDate($this->tgl_transaksi),
            "expired_at" => Helper::formatDate($this->tgl_berakhir),
        ];
    }
}
