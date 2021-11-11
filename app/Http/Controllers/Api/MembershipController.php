<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketMember;
use App\Http\Resources\MembershipCollection;
use App\Http\Resources\MembershipResource;

class MembershipController extends Controller
{
    //
    public function get()
    {
        $membership = PaketMember::whereIn('kondisi', ['POSTING'])
            ->get();
        return new MembershipCollection($membership);
    }

    public function getById($id)
    {
        $membership = PaketMember::where('id_paket', $id)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$membership) {
            return $this->responseError("Not Found", 404);
        }

        return $this->responseSuccess("Success", 200, new MembershipResource($membership));
    }
}
