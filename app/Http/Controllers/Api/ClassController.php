<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\PaketMember;
use App\Models\UserPaket;
use App\Models\PaketKelas;
use App\Http\Resources\ClassCollection;
use App\Http\Resources\ClassResource;

class ClassController extends Controller
{
    //
    public function get(Request $request)
    {
        $valid = $this->validateMembership($request);

        if (!$valid) {
            return $this->responseError("Membership not found!", 404);
        }

        $class = Kelas::with(['kursus', 'paket_kelas.paket'])
            ->whereIn('kondisi', ['POSTING'])
            ->orderBy('order_id', 'ASC')
            ->paginate(3);

        return new ClassCollection($class);
    }

    public function getById(Request $request, $id = NULL)
    {
        $valid = $this->validateMembership($request);

        if (!$valid) {
            return $this->responseError("Membership not found!", 404);
        }

        $user = $request->user;

        $class = Kelas::with(['kursus', 'paket_kelas.paket', 'pilar' => function ($q) use ($user) {
            $q->with(['kursus' => function ($r) use ($user) {
                $r->with(['paket', 'proses_kursus' => function ($s) use ($user) {
                    $s->where('id_user', $user->id_user);
                }])
                    ->whereIn('kondisi', ['POSTING'])
                    ->orderBy('order_id', 'ASC');
            }])->orderBy('order_id', 'ASC');
        }])
            ->where("id_kelas", $id)
            ->whereIn('kondisi', ['POSTING'])
            ->orderBy('order_id', 'ASC')
            ->first();

        return $this->responseSuccess("Successfully", 200, new ClassResource($class));
    }
}
