<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class GalleryResource extends JsonResource
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
            "id" => $this->id,
            "url" => Helper::getFile($this->url)
        ];
    }
}
