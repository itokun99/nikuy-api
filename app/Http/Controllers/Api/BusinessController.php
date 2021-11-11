<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserPreneur;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\BusinessCollection;
use App\Helper\Helper;
use App\Http\Resources\BusinessDetailResource;

class BusinessController extends Controller
{
    //
    public function getUserBusiness(Request $request)
    {
        $user = $request->user;
        $business = UserPreneur::where('id_user', $user->id_user)->orderBy('created_at', 'desc')->get();
        return new BusinessCollection($business);
    }

    public function getDetailUserBusiness(Request $request, $id)
    {
        $user = $request->user;
        $business = UserPreneur::with(['province'])->where([
            'id_userpreneur' => $id,
            'id_user' => $user->id_user,
        ])->first();

        if (!$business) {
            return  $this->responseError("Not Found", 404);
        }

        return new BusinessDetailResource($business);
    }

    public function createUserBusiness(Request $request)
    {
        try {
            $user = $request->user;

            $validator = Validator::make($request->all(), [
                "name" => "required",
                "description" => "required",
                "founded" => "required",
                "business_field" => "required",
                "industry" => "required",
                "address" => "required",
                "turnover" => "required",
                "phone" => "required",
                "email" => "required|email",
                "province" => "required",
                "number_of_employees" => "required"
            ]);

            if ($validator->fails()) {
                return $this->responseError("Failed to create business", 400, $validator->errors());
            }

            $business = new UserPreneur;
            $business->nama_bisnis = $request->name;
            $business->deskripsi_usaha = $request->description;
            $business->tahun_dirikan = $request->founded;
            $business->bidang_usaha = $request->business_field;
            $business->akun_instagram = $request->instagram;
            $business->page_facebook = $request->facebook;
            $business->website_bisnis = $request->website;
            $business->omset_bulanan = $request->turnover;
            $business->jumlah_karyawan = $request->number_of_employees;
            $business->id_user = $user->id_user;
            $business->id_provinsi = $request->province;
            $business->telp_bisnis = $request->phone;
            $business->alamat_bisnis = $request->address;
            $business->industri = $request->industry;
            $business->email_bisnis = $request->email;

            $photo = NULL;
            $file = request()->file('file');
            if ($file) {
                $photo = $this->uploadFile($file, Helper::getAssetPath("bisnis"));
                $business->foto_usaha = $photo;
            }
            $business->save();

            return $this->responseSuccess("Business is created successfully!", 201);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function editUserBusiness(Request $request, $id)
    {
        try {
            $business = UserPreneur::find($id);

            if (!$business) {
                return $this->responseError("Not Found", 404);
            }

            $user = $request->user;

            $validator = Validator::make($request->all(), [
                "name" => "required",
                "description" => "required",
                "founded" => "required",
                "business_field" => "required",
                "industry" => "required",
                "address" => "required",
                "turnover" => "required",
                "phone" => "required",
                "email" => "required|email",
                "province" => "required",
                "number_of_employees" => "required"
            ]);

            if ($validator->fails()) {
                return $this->responseError("Failed to update business", 400, $validator->errors());
            }

            $business->nama_bisnis = $request->name;
            $business->deskripsi_usaha = $request->description;
            $business->tahun_dirikan = $request->founded;
            $business->bidang_usaha = $request->business_field;
            $business->akun_instagram = $request->instagram;
            $business->page_facebook = $request->facebook;
            $business->website_bisnis = $request->website;
            $business->omset_bulanan = $request->turnover;
            $business->jumlah_karyawan = $request->number_of_employees;
            $business->id_user = $user->id_user;
            $business->id_provinsi = $request->province;
            $business->telp_bisnis = $request->phone;
            $business->alamat_bisnis = $request->address;
            $business->industri = $request->industry;
            $business->email_bisnis = $request->email;

            $photo = NULL;
            $prevFile = NULL;
            $file = request()->file('file');
            if ($file) {
                $photo = $this->uploadFile($file, Helper::getAssetPath("bisnis"));
                $business->foto_usaha = $photo;
            }

            $business->save();

            if ($photo && $prevFile) {
                $this->deleteFile($prevFile, Helper::getAssetPath('bisnis'));
            }

            return $this->responseSuccess("Business is updated!", 201);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }

    public function deleteUserBusiness(Request $request, $id)
    {
        try {
            $user = $request->user;

            $business = UserPreneur::where([
                'id_userpreneur' => $id,
                'id_user' => $user->id_user
            ])->first();

            if (!$business) {
                return $this->responseError("Not Found", 404);
            }

            $business->delete();
            return $this->responseSuccess("Business  deleted!", 200);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
}
