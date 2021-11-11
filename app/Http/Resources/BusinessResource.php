<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessResource extends JsonResource
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
            "id" => $this->id_userpreneur,
            "name" => $this->nama_bisnis,
            "industry" => $this->industri,
            "founded" => $this->tahun_dirikan,
            "business_field" => $this->bidang_usaha,
            "photo" => Helper::getFile('bisnis', $this->foto_usaha),
        ];
    }
}
