<?php

namespace App\Http\Resources\Location;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Str;

class CityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($data) {
            return [
                "id" => $data->city_id,
                "name" => Str::title($data->city_name)
            ];
        });
    }
}
