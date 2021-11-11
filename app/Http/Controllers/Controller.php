<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\RiwayatAdmin;
use App\Models\Riwayat;
use App\Models\UserPaket;
use App\Models\PaketMember;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateId()
    {
        $timenow = \Carbon\Carbon::now();
        $id = date('mdyhi', strtotime($timenow->toDateTimeString()));
        return $id;
    }

    public function generateToken($userId, $userEmail)
    {
        $randomHas = Hash::make("$userId|$userEmail");
        return $randomHas;
    }

    public function getPublicPath()
    {
        if (env('APP_ENV') == 'production') {
            return '/home/u1367281/public_html/';
        }
        return base_path() . '/public/';
    }

    public function deleteFile($fileName, $path = 'uploads/photo')
    {
        $fileName = $this->getPublicPath() . $path . '/' . $fileName;
        if (File::exists($fileName)) {
            File::delete($fileName);
        }
    }

    public function uploadFile($file, $path = 'uploads/photo')
    {
        $timenow = \Carbon\Carbon::now();
        $photo = $timenow->format('Ymdhis') . "." . $file->extension();
        $file->move($this->getPublicPath() . $path . '/', $photo);
        return $photo;
    }

    public function logAdmin($deskripsi, $detail = NULL)
    {
        $user = Auth::user();
        $riwayat = new RiwayatAdmin;
        $riwayat->id_user = $user->id_user;
        if ($deskripsi) {
            $riwayat->deskripsi = $deskripsi;
        }

        if ($detail) {
            $riwayat->detail = $detail;
        }
        $riwayat->save();
    }

    public function logMember($id, $deskripsi, $detail)
    {
        $riwayat = new Riwayat();
        $riwayat->id_user = $id;
        if ($deskripsi) {
            $riwayat->deskripsi = $deskripsi;
        }

        if ($detail) {
            $riwayat->detail = $detail;
        }
        $riwayat->save();
    }

    public function responseError($message = 'failed', $code = 400, $errors = NULL)
    {
        $res = [];
        $res['status'] = 0;
        $res['message'] = $message;
        if ($errors) {
            $res['errors'] = $errors;
        }

        return response()->json($res, $code);
    }

    public function responseSuccess($message = 'Success', $status = 200, $data = NULL)
    {
        $res = [
            'status' => 1,
            'message' => $message
        ];

        if ($data) {
            $res['data'] = $data;
        }

        return response()->json($res, $status);
    }

    public function serverError($errors = NULL)
    {
        return $this->responseError("Server Error", 500, [
            'message' => [$errors]
        ]);
    }

    public function validateMembership(Request $request)
    {
        $user = $request->user;
        $user_membership = UserPaket::where('id_user', $user->id_user)->first();

        if (!$user_membership) {
            return FALSE;
        }

        $membership = PaketMember::find($user_membership->id_paket);

        if (!$membership) {
            return FALSE;
        }

        return TRUE;
    }
}
