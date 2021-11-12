<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\UserAccess;

class ApiAuth
{
    public function unauthorized()
    {
        return response()->json([
            'status' => 0,
            'message' => 'Maaf, Akses di tolak'
        ], 401);
    }

    public function expired()
    {
        return response()->json([
            'status' => 0,
            'message' => 'Maaf, Sesi berakhir. Silahkan masuk kembali'
        ], 440);
    }

    public function nonactiveUser()
    {
        return response()->json([
            'status' => 0,
            'message' => 'Maaf, akun kamu sudah tidak aktif'
        ], 401);
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $token = $request->bearerToken();

        if (!$token) {
            return $this->unauthorized();
        }

        $access = UserAccess::with(['user'])
            ->where('token', $token)
            ->first();

        if (!$access) {
            return $this->expired();
        }

        if (!$access->user) {
            return $this->unauthorized();
        }

        if ($access->user->role != 'user') {
            return $this->unauthorized();
        }

        if ($access->user->status != 'active') {
            return $this->unauthorized();
        }


        $user = User::find($access->user->id);
        $request->user = $user;

        return $next($request);
    }
}
