<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Akses;
use App\Models\User;
use App\Http\Resources\ProfileResource;
use App\Helper\Helper;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ProfileController extends Controller
{
    //

    public function getProfile(Request $request)
    {
        try {
            $token = $request->bearerToken();
            $akses = Akses::where('token', $token)->first();

            if (!$akses) {
                return $this->responseError('Not Found', 404, [
                    "message" => ["Access not found"]
                ]);
            }

            $user = User::with(['province', 'paket_membership.paket'])
                ->find($akses->id_user);

            if (!$akses) {
                return $this->responseError('Not Found', 404, [
                    "message" => ["User not found, maybe unregistered or deleted in database"]
                ]);
            }

            return new ProfileResource($user);
        } catch (\Exception $e) {
            $this->serverError($e->getMessage());
        }
    }

    public function uploadPhoto(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'file' => 'required|max:5120',
            ]);

            if ($validator->fails()) {
                return $this->responseError(
                    'Upload Failed',
                    400,
                    $validator->errors()
                );
            }

            $user = $request->user;
            $photo = NULL;
            $prevFile = NULL;
            $file = request()->file('file');

            if ($file) {
                $photo = $this->uploadFile($file, Helper::getAssetPath());
                $prevFile = $user->photo;
                $user->foto = $photo;
                $user->save();
            }

            if ($photo && $prevFile) {
                $this->deleteFile($prevFile, Helper::getAssetPath());
            }

            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }


    public function deletePhoto(Request $request)
    {
        try {
            $user = $request->user;
            if ($user->foto) {
                $this->deleteFile($user->foto, Helper::getAssetPath());
                $user->foto = NULL;
                $user->save();
            }
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }


    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user;

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->responseError("Failed", 400, $validator->errors());
            }

            if ($user->email != $request->email) {
                $existing = User::where('email', $request->email)->whereIn('status', ['Aktif', 'Deactive'])->first();
                if ($existing) {
                    return $this->responseError("Failed, Email already registered", 400);
                }
                $user->email = $request->email;
            }

            if ($request->name) $user->nama_user = $request->name;
            if ($request->address) $user->alamat = $request->address;
            if ($request->dob) $user->tgl_lahir = $request->dob;
            if ($request->gender) $user->jenis_kelamin = $request->gender;
            if ($request->province) $user->provinsi = $request->province;
            if ($request->phone) $user->no_hp = $request->phone;
            if ($request->title) $user->title = $request->title;
            if ($request->summary) $user->summary = $request->summary;
            $user->save();
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $user = $request->user;

            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->responseError("Failed, Error Validation", 400, $validator->errors());
            }

            $checkOldPassword = Hash::check($request->old_password, $user->password);

            if (!$checkOldPassword) {
                return $this->responseError("Failed, wrong old password", 400);
            }

            $user->password = Hash::make($request->password);
            $user->save();
            return $this->responseSuccess();
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
