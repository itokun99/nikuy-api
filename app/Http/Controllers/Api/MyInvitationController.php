<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Invitation;
use App\Models\InvitationCouple;
use App\Models\InvitationSchedule;
use App\Models\InvitationGallery;
use App\Models\InvitationVideo;
use App\Models\InvitationRekening;
use App\Models\InvitationEwallet;
use App\Models\InvitationLocation;
use App\Models\InvitationAudio;
use App\Models\InvitationImage;
use App\Http\Resources\MyInvitation\MyInvitationCollection;
use App\Http\Resources\MyInvitation\MyInvitationResource;
use Carbon\Carbon;

class MyInvitationController extends Controller
{
    //
    public function get(Request $request)
    {
        $user = $request->user;
        $invitations = Invitation::with([
            'couples',
            'schedules',
            'image',
            'galleries',
            'videos',
            'rekening',
            'ewallets',
            'audios',
            'location' => function ($q) {
                $q->with(['province', 'city', 'district', 'subdistrict']);
            }
        ])
            ->where('author', $user->id)->get();

        return $this->responseSuccess("Berhasil", 200, new MyInvitationCollection($invitations));
    }

    public function getById(Request $request, $id)
    {
        $user = $request->user;
        $invitation = Invitation::with([
            'couples',
            'schedules',
            'image',
            'galleries',
            'videos',
            'rekening',
            'ewallets',
            'audios',
            'location' => function ($q) {
                $q->with(['province', 'city', 'district', 'subdistrict']);
            }
        ])
            ->where([
                'id' => $id,
                'author' => $user->id
            ])->first();

        if (!$invitation) {
            return $this->responseError("Undangan tidak ditemukan", 404);
        }

        return $this->responseSuccess("Undangan ditemukan", 200, new MyInvitationResource($invitation));
    }

    public function add(Request $request)
    {
        try {
            $user = $request->user;

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'description' => 'required',
                'couples' => 'required',
                'schedules' => 'required',
                'cover' => 'required',
                'thumbnail' => 'required',
                'province' => 'required',
                'city' => 'required',
                'district' => 'required',
                'subdistrict' => 'required',
                'address' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->responseError(
                    'Error, gagal membuat undangan',
                    400,
                    $validator->errors()
                );
            }

            // create invitation data
            $invitation = new Invitation;
            $invitation->id = $this->generateId();
            $invitation->title = $request->title;
            $invitation->description = $request->description;
            $invitation->author = $user->id;
            if ($request->status) {
                $invitation->status = $request->status;
            } else {
                $invitation->status = 'active';
            }

            // slug
            if ($request->url) {
                $existing_url = Invitation::where("url", $request->url)->first();

                if ($existing_url) {
                    $invitation->url = $request->url . $this->generateTimeId();
                } else {
                    $invitation->url = $request->url;
                }
            } else {
                $invitation->url = $this->generateSlug($invitation->title);
            }

            $invitation->save();

            // create invitation location
            $location = new InvitationLocation;
            $location->id = $this->generateId();
            $location->invitation_id = $invitation->id;
            $location->province_id = $request->province;
            $location->city_id = $request->city;
            $location->district_id = $request->district;
            $location->subdistrict_id = $request->subdistrict;
            $location->address = $request->address;
            $location->postal_code = $request->postal_code;
            $location->googlemap = $request->googlemap;
            $location->save();


            // create invitation image
            $image = new InvitationImage;
            $image->id = $this->generateId();
            $image->invitation = $invitation->id;

            $coverImageFile = request()->file('cover');
            $thumbnailImageFile = request()->file('thumbnail');

            if ($coverImageFile) {
                $image->cover = $this->uploadFile($coverImageFile, $image->id, 'cover');
            }

            if ($thumbnailImageFile) {
                $image->thumbnail = $this->uploadFile($thumbnailImageFile, $image->id, 'thumbnail');
            }

            $image->save();

            $reqCouples = json_decode($request->couples);
            $reqSchedules = json_decode($request->schedules);
            $reqGalleries = json_decode($request->galleries);
            $reqVideos = json_decode($request->videos);
            $reqRekening = json_decode($request->rekening);
            $reqEwallets = json_decode($request->ewallets);
            $reqAudios = json_decode($request->audios);
            $couples = [];
            $schedules = [];
            $galleries = [];
            $videos = [];
            $ewallets = [];
            $rekenings = [];
            $audios = [];


            // create couple data
            if ($reqCouples && count($reqCouples) > 0) {
                foreach ($reqCouples as $data) {
                    $couple = [
                        'id' => $data->id,
                        'name' => $data->name,
                        'description' => $data->description,
                        'invitation' => $invitation->id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    $couplePhotoFile = request()->file('couple_' . $data->id);
                    if ($couplePhotoFile) {
                        $couple['photo'] = $this->uploadFile($couplePhotoFile, $data->id, 'couple');
                    }
                    array_push($couples, $couple);
                }
            }

            // create schedule data
            if ($reqSchedules && count($reqSchedules) > 0) {
                foreach ($reqSchedules as $data) {
                    $schedule = [
                        "id" => $data->id,
                        "name" => $data->name,
                        "date" => $data->date,
                        "start" => $data->start,
                        "end" => $data->end,
                        "location" => $data->location,
                        'invitation' => $invitation->id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    array_push($schedules, $schedule);
                }
            }

            // create gallery data
            if ($reqGalleries && count($reqGalleries) > 0) {
                foreach ($reqGalleries as $data) {
                    $galleryImageFile = request()->file('gallery_' . $data->id);
                    if ($galleryImageFile) {
                        $galleryImage = $this->uploadFile($galleryImageFile, $data->id, 'gallery');
                        if ($galleryImage) {

                            $gallery = [
                                "id" => $data->id,
                                "url" => $galleryImage,
                                'invitation' => $invitation->id,
                                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                            ];
                            array_push($galleries, $gallery);
                        }
                    }
                }
            }

            // create video data
            if ($reqVideos && count($reqVideos) > 0) {
                foreach ($reqVideos as $data) {
                    $video = [
                        "id" => $data->id,
                        "url" => $data->url,
                        'invitation' => $invitation->id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    array_push($videos, $video);
                }
            }

            // create audio data
            if ($reqAudios && count($reqAudios) > 0) {
                foreach ($reqAudios as $data) {
                    $audio = [
                        "id" => $data->id,
                        "url" => $data->url,
                        'invitation' => $invitation->id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    array_push($audios, $audio);
                }
            }

            // create rekening data
            if ($reqRekening && count($reqRekening) > 0) {
                foreach ($reqRekening as $data) {
                    $rekening = [
                        'id' => $data->id,
                        'rekening' => $data->rekening,
                        'bank' => $data->bank,
                        'owner' => $data->owner,
                        'invitation' => $invitation->id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    array_push($rekenings, $rekening);
                }
            }

            // create ewallet data
            if ($reqEwallets && count($reqEwallets) > 0) {
                foreach ($reqEwallets as $data) {
                    $ewallet = [
                        'id' => $data->id,
                        'name' => $data->name,
                        'akun' => $data->akun,
                        'invitation' => $invitation->id,
                        'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                        'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                    ];

                    $qrImageFile = request()->file('ewallet_' . $data->id);
                    if ($qrImageFile) {
                        $ewallet['qr'] = $this->uploadFile($qrImageFile, $data->id, 'ewallet');
                    }

                    array_push($ewallets, $ewallet);
                }
            }


            if (count($couples) > 0) InvitationCouple::insert($couples);
            if (count($schedules) > 0) InvitationSchedule::insert($schedules);
            if (count($ewallets) > 0) InvitationEwallet::insert($ewallets);
            if (count($galleries) > 0) InvitationGallery::insert($galleries);
            if (count($rekenings) > 0) InvitationRekening::insert($rekenings);
            if (count($videos) > 0) InvitationVideo::insert($videos);
            if (count($audios) > 0) InvitationAudio::insert($audios);


            return $this->responseSuccess("Berhasil membuat undangan", 201);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function edit(Request $request, $id)
    {
        try {

            $user = $request->user;

            $invitation = Invitation::with(['location', 'image'])->where([
                "id" => $id,
                "author" => $user->id
            ])->first();

            if (!$invitation) {
                return $this->responseError("Undangan tidak ditemukan", 404);
            }

            // update invitation
            if ($request->title) $invitation->title = $request->title;
            if ($request->description) $invitation->description = $request->description;
            if ($request->status) $invitation->status = $request->status;
            if ($request->url) {
                $existing_url = Invitation::where("url", $request->url)->first();

                if ($existing_url && $existing_url->url != $invitation->url) {
                    $invitation->url = $request->url . $this->generateTimeId();
                } else {
                    $invitation->url = $request->url;
                }
            }
            $invitation->save();

            // create invitation location
            $location = InvitationLocation::where('invitation_id', $invitation->id)->first();

            if ($location) {
                if ($request->province && $location->province_id != $request->province) {
                    $location->province_id = $request->province;
                }

                if ($request->city && $location->city_id != $request->city) {
                    $location->city_id = $request->city;
                }

                if ($request->district && $location->district_id != $request->district) {
                    $location->district_id = $request->district;
                }

                if ($request->subdistrict && $location->subdistrict_id != $request->subdistrict) {
                    $location->subdistrict_id = $request->subdistrict;
                }

                if ($request->address && $location->address != $request->address) {
                    $location->address = $request->address;
                }

                if ($request->postal_code && $location->postal_code != $request->postal_code) {
                    $location->postal_code = $request->postal_code;
                }

                if ($request->googlemap && $location->googlemap != $request->googlemap) {
                    $location->googlemap = $request->googlemap;
                }
                $location->save();
            } else {
                // create invitation location
                $location = new InvitationLocation;
                $location->id = $this->generateId();
                $location->invitation_id = $invitation->id;
                $location->province_id = $request->province;
                $location->city_id = $request->city;
                $location->district_id = $request->district;
                $location->subdistrict_id = $request->subdistrict;
                $location->address = $request->address;
                $location->postal_code = $request->postal_code;
                $location->googlemap = $request->googlemap;
                $location->save();
            }



            // update image
            $image = InvitationImage::where("invitation", $invitation->id)->first();
            $coverImageFile = request()->file('cover');
            $thumbnailImageFile = request()->file('thumbnail');

            if ($image) {
                if ($coverImageFile) {
                    $prevCover = $image->cover;
                    $image->cover = $this->uploadFile($coverImageFile, $image->id, 'cover');
                    $this->deleteFile($prevCover);
                }

                if ($thumbnailImageFile) {
                    $prevThumbnail = $image->thumbnail;
                    $image->thumbnail = $this->uploadFile($thumbnailImageFile, $image->id, 'thumbnail');
                    $this->deleteFile($prevThumbnail);
                }

                $image->save();
            } else {
                $image = new InvitationImage;
                $image->id = $this->generateId();

                if ($coverImageFile) {
                    $image->cover = $this->uploadFile($coverImageFile, $image->id, 'cover');
                }

                if ($thumbnailImageFile) {
                    $image->thumbnail = $this->uploadFile($thumbnailImageFile, $image->id, 'thumbnail');
                }
                $image->save();
            }

            $reqCouples = json_decode($request->couples);
            $reqSchedules = json_decode($request->schedules);
            $reqGalleries = json_decode($request->galleries);
            $reqVideos = json_decode($request->videos);
            $reqRekening = json_decode($request->rekening);
            $reqEwallets = json_decode($request->ewallets);
            $reqAudios = json_decode($request->audios);
            $couples = [];
            $schedules = [];
            $galleries = [];
            $videos = [];
            $audios = [];
            $ewallets = [];
            $rekenings = [];


            if ($reqCouples && count($reqCouples) > 0) {
                foreach ($reqCouples as $data) {
                    $existing_couple = InvitationCouple::find($data->id);

                    if ($existing_couple) {
                        if ($existing_couple->name != $data->name) {
                            $existing_couple->name = $data->name;
                        }

                        if ($existing_couple->description != $data->description) {
                            $existing_couple->description = $data->description;
                        }

                        $couplePhotoFile = request()->file('couple_' . $existing_couple->id);
                        if ($couplePhotoFile) {
                            $prevCouplePhoto = $existing_couple->photo;
                            $existing_couple->photo = $this->uploadFile($couplePhotoFile, $data->id, 'couple');
                            $this->deleteFile($prevCouplePhoto);
                        }

                        $existing_couple->save();
                    } else {
                        $couple = [
                            'id' => $data->id,
                            'name' => $data->name,
                            'description' => $data->description,
                            'invitation' => $invitation->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ];

                        $couplePhotoFile = request()->file('couple_' . $data->id);
                        if ($couplePhotoFile) {
                            $couple['photo'] = $this->uploadFile($couplePhotoFile, $data->id, 'couple');
                        }
                        array_push($couples, $couple);
                    }
                }
            }

            if ($reqSchedules && count($reqSchedules) > 0) {
                foreach ($reqSchedules as $data) {

                    $existing_schedule = InvitationSchedule::find($data->id);

                    if ($existing_schedule) {
                        if ($existing_schedule->name != $data->name) {
                            $existing_schedule->name = $data->name;
                        }

                        if ($existing_schedule->date != $data->date) {
                            $existing_schedule->date = $data->date;
                        }

                        if ($existing_schedule->start != $data->start) {
                            $existing_schedule->start = $data->start;
                        }

                        if ($existing_schedule->end != $data->end) {
                            $existing_schedule->end = $data->end;
                        }

                        if ($existing_schedule->location != $data->location) {
                            $existing_schedule->location = $data->location;
                        }
                        $existing_schedule->save();
                    } else {
                        $schedule = [
                            "id" => $data->id,
                            "name" => $data->name,
                            "date" => $data->date,
                            "start" => $data->start,
                            "end" => $data->end,
                            "location" => $data->location,
                            'invitation' => $invitation->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ];

                        array_push($schedules, $schedule);
                    }
                }
            }

            // create gallery data
            if ($reqGalleries && count($reqGalleries) > 0) {
                foreach ($reqGalleries as $data) {

                    $existing_gallery = InvitationGallery::find($data->id);

                    if ($existing_gallery) {
                        $galleryImageFile = request()->file('gallery_' . $existing_gallery->id);
                        if ($galleryImageFile) {
                            $prevGalleryImage = $existing_gallery->url;
                            $existing_gallery->url = $this->uploadFile($galleryImageFile, $data->id, 'gallery');
                            $this->deleteFile($prevGalleryImage);
                        }
                        $existing_gallery->save();
                    } else {
                        $galleryImageFile = request()->file('gallery_' . $data->id);
                        if ($galleryImageFile) {
                            $galleryImage = $this->uploadFile($galleryImageFile, $data->id, 'gallery');
                            if ($galleryImage) {

                                $gallery = [
                                    "id" => $data->id,
                                    "url" => $galleryImage,
                                    'invitation' => $invitation->id,
                                    'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                                    'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                                ];
                                array_push($galleries, $gallery);
                            }
                        }
                    }
                }
            }

            // create video data
            if ($reqVideos && count($reqVideos) > 0) {
                foreach ($reqVideos as $data) {
                    $existing_video = InvitationVideo::find($data->id);

                    if ($existing_video) {
                        if ($existing_video->url != $data->url) {
                            $existing_video->url = $data->url;
                        }

                        $existing_video->save();
                    } else {
                        $video = [
                            "id" => $data->id,
                            "url" => $data->url,
                            'invitation' => $invitation->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ];

                        array_push($videos, $video);
                    }
                }
            }

            // create audio data
            if ($reqAudios && count($reqAudios) > 0) {
                foreach ($reqAudios as $data) {
                    $existing_audio = InvitationAudio::find($data->id);

                    if ($existing_audio) {
                        if ($existing_audio->url != $data->url) {
                            $existing_audio->url = $data->url;
                        }

                        $existing_audio->save();
                    } else {
                        $audio = [
                            "id" => $data->id,
                            "url" => $data->url,
                            'invitation' => $invitation->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ];

                        array_push($audios, $audio);
                    }
                }
            }

            // create rekening data
            if ($reqRekening && count($reqRekening) > 0) {
                foreach ($reqRekening as $data) {

                    $existing_rekening = InvitationRekening::find($data->id);

                    if ($existing_rekening) {

                        if ($existing_rekening->rekening != $data->rekening) {
                            $existing_rekening->rekening = $data->rekening;
                        }

                        if ($existing_rekening->bank != $data->bank) {
                            $existing_rekening->bank = $data->bank;
                        }

                        if ($existing_rekening->owner != $data->owner) {
                            $existing_rekening->owner = $data->owner;
                        }

                        $existing_rekening->save();
                    } else {
                        $rekening = [
                            'id' => $data->id,
                            'rekening' => $data->rekening,
                            'bank' => $data->bank,
                            'owner' => $data->owner,
                            'invitation' => $invitation->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ];

                        array_push($rekenings, $rekening);
                    }
                }
            }


            // create ewallet data
            if ($reqEwallets && count($reqEwallets) > 0) {
                foreach ($reqEwallets as $data) {

                    $existing_ewallet = InvitationEwallet::find($data->id);

                    if ($existing_ewallet) {
                        if ($existing_ewallet->name != $data->name) {
                            $existing_ewallet->name = $data->name;
                        }

                        if ($existing_ewallet->akun != $data->akun) {
                            $existing_ewallet->akun = $data->akun;
                        }

                        $qrImageFile = request()->file('ewallet_' . $existing_ewallet->id);
                        if ($qrImageFile) {
                            $prevQrImage = $existing_ewallet->qr;
                            $existing_ewallet->qr = $this->uploadFile($qrImageFile, $data->id, 'ewallet');
                            $this->deleteFile($prevQrImage);
                        }
                        $existing_ewallet->save();
                    } else {
                        $ewallet = [
                            'id' => $data->id,
                            'name' => $data->name,
                            'akun' => $data->akun,
                            'invitation' => $invitation->id,
                            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                            'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
                        ];

                        $qrImageFile = request()->file('qr_' . $data->id);
                        if ($qrImageFile) {
                            $ewallet['qr'] = $this->uploadFile($qrImageFile, $data->id, 'ewallet');
                        }

                        array_push($ewallets, $ewallet);
                    }
                }
            }

            if (count($couples) > 0) InvitationCouple::insert($couples);
            if (count($schedules) > 0) InvitationSchedule::insert($schedules);
            if (count($ewallets) > 0) InvitationEwallet::insert($ewallets);
            if (count($galleries) > 0) InvitationGallery::insert($galleries);
            if (count($rekenings) > 0) InvitationRekening::insert($rekenings);
            if (count($videos) > 0) InvitationVideo::insert($videos);
            if (count($audios) > 0) InvitationAudio::insert($audios);

            return $this->responseSuccess("Berhasil memperbarui undangan", 200);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function delete(Request $request, $id)
    {
        try {
            $user = $request->user;
            $invitation = Invitation::with([
                'user',
                'couples',
                'galleries',
                'schedules',
                'videos',
                'ewallets',
                'rekening',
                'image',
                'location'
            ])
                ->where([
                    "id" => $id,
                    "author" => $user->id
                ])->first();

            if (!$invitation) {
                return $this->responseError("Undangan tidak ditemukan", 404);
            }

            if ($invitation->couples && count($invitation->couples) > 0) {
                foreach ($invitation->couples as $a) {
                    $this->deleteFile($a->photo);
                }
            }

            InvitationCouple::where('invitation', $invitation->id)->delete();

            if ($invitation->galleries && count($invitation->galleries) > 0) {
                foreach ($invitation->galleries as $a) {
                    $this->deleteFile($a->url);
                }
            }

            InvitationGallery::where('invitation', $invitation->id)->delete();
            InvitationSchedule::where('invitation', $invitation->id)->delete();

            if ($invitation->videos && count($invitation->videos) > 0) {
                foreach ($invitation->videos as $a) {
                    $this->deleteFile($a->url);
                }
            }

            InvitationVideo::where('invitation', $invitation->id)->delete();
            InvitationRekening::where('invitation', $invitation->id)->delete();

            if ($invitation->ewallets && count($invitation->ewallets) > 0) {
                foreach ($invitation->ewallets as $a) {
                    $this->deleteFile($a->qr);
                }
            }

            InvitationEwallet::where('invitation', $invitation->id)->delete();

            if ($invitation->image) {
                $this->deleteFile($invitation->image->cover);
                $this->deleteFile($invitation->image->thumbnail);
            }


            InvitationImage::where('invitation', $invitation->id)->delete();
            InvitationLocation::where('invitation_id', $invitation->id)->delete();

            $invitation->delete();
            return $this->responseSuccess("Berhasil menghapus undangan", 200);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
