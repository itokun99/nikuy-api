<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ProvinceResource;
use App\Http\Resources\ProfileMembershipResource;
use App\Helper\Helper;

class ProfileResource extends JsonResource
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
            'status' => 1,
            'message' => 'User Founded',
            'data' => [
                'id' => $this->id_user,
                'name' => $this->nama_user,
                'email' => $this->email,
                'phone' => $this->no_hp,
                'dob' => $this->tgl_lahir,
                'gender' => $this->jenis_kelamin,
                'address' => $this->alamat,
                'province' => new ProvinceResource($this->province),
                'title' => $this->title,
                'photo' => Helper::getFile('profile', $this->foto),
                'summary' => $this->summary,
                'membership' => new ProfileMembershipResource($this->paket_membership)
            ]
        ];
    }
}
