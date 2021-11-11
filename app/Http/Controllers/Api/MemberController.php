<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\MemberCollection;
use App\Http\Resources\MemberResource;

class MemberController extends Controller
{
    //
    public function getMembers(Request $request)
    {
        $search = $request->get('search');

        $members = new User;

        if ($request->has('search')) {
            $members = $members->where('nama_user', 'like', '%' . $search . '%');
        }


        $members = $members->orderBy('nama_user', 'asc')
            ->whereIn('hak_akses', ['Member'])
            ->whereIn('status', ['Aktif'])
            ->paginate(10);

        return new MemberCollection($members);
    }

    public function getMemberById($id)
    {
        try {
            $member = User::with(['province'])->find($id);

            if (!$member) {
                return $this->responseError("Not Found", 404, [
                    "message" => ["Member not found"]
                ]);
            }

            return new MemberResource($member);
        } catch (\Exception $e) {
            return $this->responseError("Server Error!", 500,  [
                "message" => [$e->getMessage()]
            ]);
        }
    }
}
