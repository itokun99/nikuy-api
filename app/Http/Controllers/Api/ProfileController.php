<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAccess;
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
            $access = UserAccess::where('token', $token)->first();

            if (!$access) {
                return $this->responseError('Not Found', 404, [
                    "message" => ["Access not found"]
                ]);
            }

            $user = User::with(['province'])->find($access->user_id);

            if (!$access) {
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
                $user->photo = $photo;
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
            if ($user->photo) {
                $this->deleteFile($user->photo, Helper::getAssetPath());
                $user->photo = NULL;
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
                $existing = User::where('email', $request->email)->whereIn('status', ['active', 'nonactive'])->first();
                if ($existing) {
                    return $this->responseError("Failed, Email already registered", 400);
                }
                $user->email = $request->email;
            }

            if ($request->name) $user->name = $request->name;
            if ($request->address) $user->address = $request->address;
            if ($request->dob) $user->dob = $request->dob;
            if ($request->gender) $user->gender = $request->gender;
            if ($request->province) $user->province = $request->province;
            if ($request->phone) $user->phone = $request->phone;
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
