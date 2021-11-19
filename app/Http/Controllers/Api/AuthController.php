<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Auth\LoginResource;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if ($validator->fails()) {
                return $this->responseError(
                    'Login Failed',
                    400,
                    $validator->errors()
                );
            }

            $user = User::with(['access'])
                ->where('email', $request->email)
                ->whereIn('role', ['user'])
                ->first();

            if (!$user) {
                return $this->responseError('Maaf, Email tidak terdaftar', 404);
            }

            if ($user->status != 'active') {
                return $this->responseError('Maaf, Akun dinonaktifkan karena suatu alasan, silahkan hubungi tim support pada halaman kontak', 400);
            }

            if (!Hash::check($request->password, $user->password)) {
                return $this->responseError('Maaf, kata sandi salah', 400);
            }

            if (!$user->access) {
                $access = UserAccess::create([
                    'user_id' => $user->id,
                    'token' => $this->generateToken($user->id, $user->email)
                ]);

                if (!$access) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Maaf, terjadi kesalahan sistem',
                    ], 400);
                }
                $user->access = $access;
            }

            return $this->responseSuccess(
                "Hore! berhasil masuk",
                200,
                new LoginResource($user)
            );
        } catch (\Exception $e) {

            return $this->serverError($e->getMessage());
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
                'name' => 'required',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->responseError(
                    'Maaf, pendaftaran akun gagal',
                    400,
                    $validator->errors()
                );
            }

            $id = $this->generateId();
            $user = new User;
            $user->id = $id;
            $user->name = $request->name;
            $user->username = $this->generateUsername();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = "user";
            $user->status = 'active';
            $user->save();

            return $this->responseSuccess('Hore!, pendaftaran berhasil', 201);
        } catch (\Exception $e) {
            return $this->serverError($e->getMessage());
        }
    }
    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $akses = UserAccess::where([
            "user_id" => $request->user->id,
            'token' => $token
        ])->first();

        if ($akses) {
            $akses->delete();
        }

        return $this->responseSuccess();
    }
}
