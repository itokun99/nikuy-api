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

        $access = UserAccess::where('token', $token)->first();

        if (!$access) {
            return $this->unauthorized();
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
