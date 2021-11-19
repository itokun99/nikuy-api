<?php

namespace App\Http\Resources\MyInvitation;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\MyInvitation\ImageResource;
use App\Http\Resources\MyInvitation\GalleryResource;
use App\Http\Resources\MyInvitation\VideoResource;
use App\Http\Resources\MyInvitation\EwalletResource;
use App\Http\Resources\MyInvitation\ScheduleResource;
use App\Http\Resources\MyInvitation\LocationResource;
use App\Http\Resources\MyInvitation\RekeningResource;
use App\Http\Resources\MyInvitation\CoupleResource;

class MyInvitationResource extends JsonResource
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
            "id" => $this->id,
            "title" => $this->title,
            "description" => $this->description,
            "slug" => $this->url,
            "status" => $this->status,
            "image" => new ImageResource($this->image),
            "location" => new LocationResource($this->location),
            "couples" => CoupleResource::collection($this->couples),
            "schedules" => ScheduleResource::collection($this->schedules),
            "galleries" => GalleryResource::collection($this->galleries),
            "videos" => VideoResource::collection($this->videos),
            "ewallets" => EwalletResource::collection($this->ewallets),
            "rekening" => RekeningResource::collection($this->rekening),
        ];
    }
}
