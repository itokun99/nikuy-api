<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class BusinessDetailResource extends JsonResource
{
    public function getProvince($data)
    {
        if (!$data) {
            return NULL;
        }

        return [
            "id" => $data->id_provinsi,
            "name" => $data->nama_provinsi,
        ];
    }
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "status" => 1,
            "message" => "Successfully",
            "data" => [
                "id" => $this->id_userpreneur,
                "name" => $this->nama_bisnis,
                "description" => $this->deskripsi_usaha,
                "founded" => $this->tahun_dirikan,
                "business_field" => $this->bidang_usaha,
                "industry" => $this->industri,
                "turnover" => $this->omset_bulanan,
                "number_of_employees" => $this->jumlah_karyawan,
                "address" => $this->alamat_bisnis,
                "phone" => $this->telp_bisnis,
                "email" => $this->email_bisnis,
                "photo" => Helper::getFile("bisnis", $this->foto_usaha),
                "instagram" => $this->akun_instagram,
                "facebook" => $this->page_facebook,
                "website" => $this->website_bisnis,
                "province" => $this->getProvince($this->province)
            ]
        ];
    }
}
