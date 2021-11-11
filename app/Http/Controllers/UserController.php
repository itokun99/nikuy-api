<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PaketMember;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use App\Exports\MemberExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function user()
    {
        $user = User::find(\Auth::user()->id_user);
        $paket_member = PaketMember::find(\Auth::user()->id_paket);
        $provinsi = Provinsi::all();

        return view('web.pages.profile.index')->with(["user" => $user, "paket_member" => $paket_member, "provinsi" => $provinsi]);
    }

    public static function check_foto()
    {
        if (\Auth::user()) {
            $user = User::find(\Auth::user()->id_user);
            return $user->foto;
        }
        return null;
    }

    public function photo()
    {
        $validator = Validator::make(request()->all(), [
            'foto' => 'max:5120',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);


        $file = request()->file('foto');
        $photo = \Auth::user()->id_user . "." . $file->extension();
        if (env('APP_ENV') == 'production') {
            $file->move('/home/u1367281/public_html/uploads/photo/', $photo);
        } else {
            $file->move(base_path() . '/public/uploads/photo/', $photo);
        }

        $user = User::find(\Auth::user()->id_user);
        $user->foto = $photo;
        $user->save();

        return redirect()->back()->with('message', 'Berhasil mengupload foto');
    }

    public function update_user()
    {

        $user = User::find(\Auth::user()->id_user);

        if (!$user) {
            return abort(404);
        }

        $request = request();
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'email' => 'required|unique:content',
            'nama_user' => 'required|min:3',
            'alamat' => 'required',
            'provinsi' => 'required',
            'tglahir' => 'required|date',
            'jekel' => 'required',
            'nohp' => 'required|min:3',
            'email' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->old_password || $request->password || $request->password_confirmation) {
            $validator = Validator::make($request->all(), [
                'old_password' => 'required',
                'password' => 'required|min:6|confirmed'
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            if (!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->withErrors([
                    'message' => 'Password lama salah'
                ]);
            }

            $user->password = Hash::make($request->password);
        }

        $user->nama_user = $request->nama_user;
        $user->alamat = $request->alamat;
        $user->provinsi = $request->provinsi;
        $user->tgl_lahir = $request->tglahir;
        $user->jenis_kelamin = $request->jekel;
        $user->no_hp = $request->nohp;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil di update');
    }
}
