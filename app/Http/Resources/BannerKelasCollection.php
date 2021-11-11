<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Helper\Helper;
use App\Http\Resources\BannerKelasResource;

class BannerKelasCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status' => 1,
            'message' => 'Success',
            'data' => BannerKelasResource::collection($this->collection)
        ];
    }
}
