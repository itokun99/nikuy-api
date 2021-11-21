<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invitation;
use App\Http\Resources\MyInvitation\MyInvitationCollection;
use App\Http\Resources\MyInvitation\MyInvitationResource;

class InvitationController extends Controller
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
        ])->get();

        return $this->responseSuccess("Berhasil", 200, new MyInvitationCollection($invitations));
    }

    public function getDetail(Request $request, $id)
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
            ->where('url', $id)
            ->orWhere('id', $id)
            ->first();

        if (!$invitation) {
            return $this->responseError("Undangan tidak ditemukan", 404);
        }

        return $this->responseSuccess("Undangan ditemukan", 200, new MyInvitationResource($invitation));
    }
}
