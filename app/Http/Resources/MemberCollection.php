<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MemberCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);

        return [
            'status' => 0,
            'message' => 'Successfull',
            'data' => $this->collection->map(function ($user) {
                return [
                    'id' => $user->id_user,
                    'name' => $user->nama_user,
                    'photo' => Helper::getFile('member', $user->foto),
                    'title' => $user->title
                ];
            })
        ];
    }
}
