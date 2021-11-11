<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    public function login_page()
    {
        if (Auth::check() && (Auth::user()->hak_akses == 'Administrator' || Auth::user()->hak_akses == 'Super Admin')) {
            return redirect("/admin/dashboard");
        }
        return view('admin.pages.login.index');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return back()->withErrors([
                'message' => 'Admin tidak ditemukan'
            ])->withInput();
        }

        $user = User::where('email', $request->email)
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->whereIn('status', ['Aktif'])
            ->first();

        if (!$user) {
            return back()->withErrors([
                'message' => 'Admin tidak ditemukan'
            ])->withInput();
        }

        $this->logAdmin('Login Admin');
        $request->session()->regenerate();
        return redirect('/admin')->with('success', 'Selamat datang di Admin ELITES');
    }

    public function logout(Request $request)
    {
        $this->logAdmin('Logout Admin');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }
}
