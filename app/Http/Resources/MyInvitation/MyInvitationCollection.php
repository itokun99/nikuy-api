<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Helper\Helper;
use Illuminate\Support\Str;

class MyInvitationCollection extends ResourceCollection
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

        return $this->collection->map(function ($data) {
            return [
                "id" => $data->id,
                "title" => $data->title,
                "slug" => $data->url,
                "thumbnail" => Helper::getFile($data->image->thumbnail),
                "location" => Str::title($data->location->city->city_name),
                "date" => $data->schedules[0]->date,
                "status" => $data->status,
            ];
        });
    }
}
