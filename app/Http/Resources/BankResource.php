<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class BankResource extends JsonResource
{
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
            "id" => $this->id,
            "name" => $this->nama,
            "logo" => Helper::getFile('bank', $this->logo),
            "code" => $this->kode,
            "instruction" => $this->intruksi
        ];
    }
}
