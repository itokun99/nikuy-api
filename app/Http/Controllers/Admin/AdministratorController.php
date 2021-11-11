<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Auth;


class AdministratorController extends Controller
{
    public function index_page()
    {
        $auth_user = Auth::user();
        $admins = User::whereIn('status', ['Aktif', 'Deactive'])
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->whereNotIn('id_user', [$auth_user->id_user])
            ->paginate(10);

        return view('admin.pages.setting.administrator.index')->with(["administrator" => $admins]);
    }

    public function add_page()
    {
        $provinsi = Provinsi::all();
        return view('admin.pages.setting.administrator.form')
            ->with([
                'user' => null,
                "provinsi" => $provinsi,
            ]);
    }

    public function edit_page($id)
    {
        $user = User::where('id_user', $id)
            ->whereIn('status', ['Aktif', 'Deactive'])
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->first();

        if (!$user) {
            return abort(404);
        }

        $provinsi = Provinsi::all();
        return view('admin.pages.setting.administrator.form')
            ->with([
                'user' => $user,
                "provinsi" => $provinsi,
            ]);
    }

    public function detail_page($id)
    {
        $user = User::with(['province'])
            ->where('id_user', $id)
            ->whereIn('status', ['Aktif', 'Deactive'])
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->first();

        if (!$user) {
            return abort(404);
        }

        return view('admin.pages.setting.administrator.detail', [
            "user" => $user
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user',
            'nama' => 'required',
            'password' => 'required|min:6|confirmed',
            'status' => 'required',
            'hak_akses' => 'required',
            'foto' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $photo = NULL;
        $file = request()->file('foto');
        $id = $this->generateId();

        if ($file) {
            $photo = $this->uploadFile($file, 'uploads/photo');
        }

        $user = new User;
        $user->id_user = $id;
        $user->nama_user = $request->nama;
        $user->alamat = $request->alamat;
        $user->provinsi = $request->provinsi;
        $user->tgl_lahir = $request->tglahir;
        $user->jenis_kelamin = $request->jekel;
        $user->no_hp = $request->nohp;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->foto = $photo;
        $user->hak_akses = $request->hak_akses;
        $user->status = $request->status;
        $user->setuju = "ya";
        $user->save();

        $this->logAdmin("Memambahkan Admin $user->email", json_encode($user));

        return redirect("/admin/administrator")->with('success', 'Berhasil menambahkan admin baru');
    }

    public function edit(Request $request, $id)
    {
        $user = User::with(['province'])
            ->where('id_user', $id)
            ->whereIn('status', ['Aktif', 'Deactive'])
            ->whereIn('hak_akses', ['Administrator', 'Super Admin'])
            ->first();

        if (!$user) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'status' => 'required',
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
        $id = $this->generateId();
        if ($file) {
            $photo = $this->uploadFile($file, 'uploads/photo');
            $prevFotoFile = $user->foto;
            $user->foto = $photo;
        }

        // validasi untuk perubahan status user
        if ($user->status != $request->status) {
            $user->status = $request->status;
        }

        $user->nama_user = $request->nama;
        $user->alamat = $request->alamat;
        $user->tgl_lahir = $request->tglahir;
        $user->jenis_kelamin = $request->jekel;
        $user->provinsi = $request->provinsi;
        $user->no_hp = $request->nohp;

        if ($request->hak_akses) {
            $user->hak_akses = $request->hak_akses;
        }

        $user->save();

        // validasi hapus foto
        if ($photo && $prevFotoFile) {
            $this->deleteFile($prevFotoFile, 'uploads/photo');
        }

        $this->logAdmin("Mengedit Admin $user->email", json_encode($user));

        return redirect("/admin/administrator")->with('success', 'Berhasil memperbarui data member');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }


        if ($user->foto) {
            $this->deleteFile($user->foto, 'uploads/photo');
        }

        $this->logAdmin("Menghapus Admin $user->email", json_encode($user));

        $user->delete();
        return redirect('/admin/administrator')->with('success', "Berhasil menghapus member $user->nama_user");
    }
}
