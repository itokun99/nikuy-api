<?php

namespace App\Http\Resources;

use App\Http\Resources\ProvinceResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProvinceCollection extends ResourceCollection
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
            'status' => 1,
            'message' => 'Successfully',
            'data' => ProvinceResource::collection($this->collection)
        ];
    }
}
