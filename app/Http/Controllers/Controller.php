<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function generateId()
    {
        // $timenow = \Carbon\Carbon::now();
        // $id = date('mdyhi', strtotime($timenow->toDateTimeString()));
        // return $id;

        return Str::uuid();
    }

    public function generateUsername()
    {
        $timenow = \Carbon\Carbon::now();
        $id = date('mdyhi', strtotime($timenow->toDateTimeString()));
        return `user$id`;
    }

    public function generateToken($userId, $userEmail)
    {
        $randomHas = Hash::make("$userId|$userEmail", [
            "rounds" => 12,
        ]);
        $randomHas = Hash::make("$randomHas|$userId|$randomHas", [
            "rounds" => 10,
        ]);
        return "$randomHas" . "$$userId$" . "$randomHas";
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
        return $this->responseError("Maaf, terjadi kesalahan sistem", 500, [
            'message' => [$errors]
        ]);
    }
}
