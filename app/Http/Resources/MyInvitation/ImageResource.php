<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helper\Helper;

class ImageResource extends JsonResource
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
            "cover" => Helper::getFile($this->cover),
            "thumbnail" => Helper::getFile($this->thumbnail)
        ];
    }
}
