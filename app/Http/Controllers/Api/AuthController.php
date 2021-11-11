<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Akses;
use App\Models\PaketMember;
use App\Models\UserPaket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;
use App\Helper\Helper;


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

            if (!Auth::attempt([
                'email' => $request->email,
                'password' => $request->password,
                'status' => 'Aktif',
                'hak_akses' => 'Member'
            ])) {
                return $this->responseError('Login Failed', 400, [
                    'message' => ["Wrong Email / Password"],
                ]);
            }

            $user = User::with(['akses'])
                ->where('email', $request->email)
                ->whereIn('status', ['Aktif'])
                ->whereIn('hak_akses', ['Member'])
                ->first();

            if (!$user->akses) {
                $akses = Akses::create([
                    'id_user' => $user->id_user,
                    'token' => $this->generateToken($user->id_user, $user->email)
                ]);

                if (!$akses) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Login Failed',
                        'errors' => [
                            'message' => "Fail generate token",
                        ]
                    ], 400);
                }
                $user->akses = $akses;
            }

            return new LoginResource($user);
        } catch (\Exception $e) {

            return $this->responseError('Server Error', 500, [
                'message' => [$e->getMessage()],
            ]);
        }
    }

    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:user,email,NULL,id_user,deleted_at,NULL',
                'name' => 'required',
                'address' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'phone' => 'required|max:15',
                'password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return $this->responseError(
                    'Registration failed',
                    400,
                    $validator->errors()
                );
            }

            $paket = PaketMember::where('default', 1)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            $id = $this->generateId();

            $user = new User;
            $user->id_user = $id;
            $user->nama_user = $request->name;
            $user->alamat = $request->address;
            $user->tgl_lahir = $request->dob;
            $user->jenis_kelamin = $request->gender;
            $user->no_hp = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->hak_akses = "Member";
            $user->status = 'Aktif';
            $user->setuju = "ya";
            $user->id_paket = NULL;
            $user->save();

            $sub = Helper::getSubscribeAndExpired($paket->masa_berlaku);

            if ($paket) {
                UserPaket::create([
                    'id_user' => $id,
                    'id_paket' => $paket->id_paket,
                    'subscribe_at' => $sub->subscribe_at,
                    'expired_at' => $sub->expired_at,
                ]);
            }

            return $this->responseSuccess('Registration successfull', 201);
        } catch (\Exception $e) {
            return $this->responseError("Server Error", 500, [
                'message' => [$e->getMessage()]
            ]);
        }
    }
    public function logout(Request $request)
    {
        $token = $request->bearerToken();
        $akses = Akses::where('token', $token);

        if ($akses) {
            $akses->delete();
        }

        return $this->responseSuccess();
    }
}
