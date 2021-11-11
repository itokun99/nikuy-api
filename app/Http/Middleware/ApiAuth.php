<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use App\Models\Akses;

class ApiAuth
{
    public function unauthorized()
    {
        return response()->json([
            'status' => 0,
            'message' => 'Unauthorized'
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

        $akses = Akses::where('token', $token)->first();

        if (!$akses) {
            return $this->unauthorized();
        }

        if (!$akses->user) {
            return $this->unauthorized();
        }

        if ($akses->user->hak_akses != 'Member') {
            return $this->unauthorized();
        }

        if ($akses->user->status != 'Aktif') {
            return $this->unauthorized();
        }


        $user = User::find($akses->user->id_user);
        $request->user = $user;

        return $next($request);
    }
}
