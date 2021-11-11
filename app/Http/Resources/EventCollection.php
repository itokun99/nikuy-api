<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Helper\Helper;
use App\Http\Resources\EventAuthorResource;
use App\Http\Resources\EventResource;
use Illuminate\Support\Carbon;

class EventCollection extends ResourceCollection
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
            'data' => EventResource::collection($this->collection)
        ];
    }
}
