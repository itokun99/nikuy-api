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
                'id' => $this->id,
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'dob' => $this->dob,
                'gender' => $this->gender,
                'address' => $this->address,
                'province' => $this->province,
                'photo' => Helper::getFile($this->foto),
            ]
        ];
    }
}
