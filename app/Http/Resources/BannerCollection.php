<?php

namespace App\Http\Resources;

use App\Helper\Helper;
use Illuminate\Http\Resources\Json\ResourceCollection;

class BannerCollection extends ResourceCollection
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
            'data' => $this->collection->map(function ($banner) {
                return [
                    'id' => $banner->id_slider,
                    'image' => Helper::getFile('banner', $banner->foto_slider),
                    'link' => $banner->link,
                    'order' => $banner->order,
                    'alt' => $banner->alt,
                ];
            })
        ];
    }
}
