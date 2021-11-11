<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return abort(404);
        }

        $isAdmin = Auth::user()->hak_akses == 'Administrator' || Auth::user()->hak_akses == 'Super Admin' ? TRUE : FALSE;

        if (!$isAdmin) {
            return abort(404);
        }

        return $next($request);
    }
}
