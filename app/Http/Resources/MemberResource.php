<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class MemberResource extends JsonResource
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
            'status' => 1,
            'message' => 'Successfully',
            'data' => [
                'id' => $this->id_user,
                'name' => $this->nama_user,
                'photo' => Helper::getFile('member', $this->foto),
                'email' => $this->email,
                'address' => $this->alamat,
                'province' => $this->province->nama_provinsi ?? NULL,
                'dob' => $this->tgl_lahir,
                'gender' => $this->jenis_kelamin,
                'phone' => $this->no_hp,
                'title' => $this->title,
                'summary' => $this->summary
            ]
        ];
    }
}
