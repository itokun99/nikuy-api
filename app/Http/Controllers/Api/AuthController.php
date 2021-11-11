<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAccess;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\LoginResource;


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
                'status' => 'active',
                'role' => 'user'
            ])) {
                return $this->responseError('Login Failed', 400, [
                    'message' => ["Wrong Email / Password"],
                ]);
            }

            $user = User::with(['access'])
                ->where('email', $request->email)
                ->whereIn('status', ['active'])
                ->whereIn('role', ['user'])
                ->first();

            if (!$user->access) {
                $access = UserAccess::create([
                    'user_id' => $user->id,
                    'token' => $this->generateToken($user->id, $user->email)
                ]);

                if (!$access) {
                    return response()->json([
                        'status' => 0,
                        'message' => 'Login Failed',
                        'errors' => [
                            'message' => "Fail generate token",
                        ]
                    ], 400);
                }
                $user->access = $access;
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
                'email' => 'required|email|unique:user,email,NULL,id,deleted_at,NULL',
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

            $id = $this->generateId();
            $user = new User;
            $user->id = $id;
            $user->name = $request->name;
            $user->address = $request->address;
            $user->dob = $request->dob;
            $user->gender = $request->gender;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = "user";
            $user->status = 'active';
            $user->save();

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
        $akses = UserAccess::where('token', $token);

        if ($akses) {
            $akses->delete();
        }

        return $this->responseSuccess();
    }
}
