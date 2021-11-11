<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    //

    public function index_page()
    {
        $user = User::with(['province'])
            ->where('id_user', Auth::user()->id_user)
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->whereIn('status', ['Aktif'])
            ->first();

        if (!$user) {
            return abort(404);
        }

        $provinsi = Provinsi::orderBy('nama_provinsi', 'asc')->get();

        return view('admin.pages.profile.index', [
            'user' => $user,
            'provinsi' => $provinsi
        ]);
    }

    public function edit(Request $request)
    {
        $user = User::where('id_user', Auth::user()->id_user)
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->whereIn('status', ['Aktif'])
            ->first();

        if (!$user) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'foto' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($user->email != $request->email) {
            $existing = User::where('email', $request->email)
                ->whereIn('status', ['Aktif', 'Deactive'])
                ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
                ->first();

            if ($existing) {
                return redirect()->back()->withErrors([
                    "message" => "Email $request->email sudah digunakan, gunakan email yang lain"
                ]);
            }

            $user->email = $request->email;
        }

        // validasi perubahan kata sandi user
        if ($request->password) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $user->password = Hash::make($request->password);
        }

        $photo = NULL;
        $prevFotoFile = NULL;
        $file = request()->file('foto');
        if ($file) {
            $photo = $this->uploadFile($file, 'uploads/photo');
            $prevFotoFile = $user->foto;
            $user->foto = $photo;
        }

        $user->nama_user = $request->nama;
        $user->alamat = $request->alamat;
        $user->tgl_lahir = $request->tglahir;
        $user->jenis_kelamin = $request->jekel;
        $user->provinsi = $request->provinsi;
        $user->no_hp = $request->nohp;

        $user->save();

        // validasi hapus foto
        if ($photo && $prevFotoFile) {
            $this->deleteFile($prevFotoFile, 'uploads/photo');
        }

        $this->logAdmin("Mengubah Profile", json_encode($user));

        return redirect()
            ->back()
            ->with('success', 'Berhasil memperbarui data member');
    }
}
