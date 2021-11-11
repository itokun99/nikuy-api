<?php

namespace App\Http\Controllers;

use App\Models\UserPreneur;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserPreneurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function userpreneur()
    {
        $bisnis = UserPreneur::where('id_user', \Auth::user()->id_user)->first();
        // $bisnis = UserPreneur::where('id_user', 123)->first();
        return view('web.pages.profile.bisnis.index')->with(["bisnis" => $bisnis]);
    }

    public function user_preneur()
    {
        //
        $bisnis = User::find(\Auth::user()->id_user);
        return view('akun_bisnis')->with(["bisnis" => $bisnis]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User_preneur  $user_preneur
     * @return \Illuminate\Http\Response
     */

    public function store_preneur()

    {
        $request = request();
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'deskripsi_usaha' => 'required',
            'jumlah_karyawan' => 'required',
            'omset_bulanan' => 'required',
            'nama_bisnis' => 'required',
            'tahun_dirikan' => 'required|max:4',
            'bidang_usaha' => 'required',
            'industri' => 'required',
            'provinsi' => 'required',
            'alamat_bisnis' => 'required',
            'email_bisnis' => 'required',
            'telp_bisnis' => 'required',
            // 'akun_instagram'=>'required',
            // 'page_facebook'=>'required',
            // 'website_bisnis'=>'required',
            'foto_usaha' => 'max:5120',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $photo = '';
        $file = request()->file('foto_usaha');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/bisnismember/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/bisnismember/', $photo);
            }
        }

        $bisnis = new UserPreneur;
        $bisnis->deskripsi_usaha = $request->deskripsi_usaha;
        $bisnis->jumlah_karyawan = $request->jumlah_karyawan;
        $bisnis->omset_bulanan = $request->omset_bulanan;
        $bisnis->nama_bisnis = $request->nama_bisnis;
        $bisnis->tahun_dirikan = $request->tahun_dirikan;
        $bisnis->bidang_usaha = $request->bidang_usaha;
        $bisnis->industri = $request->industri;
        $bisnis->id_provinsi = $request->provinsi;
        $bisnis->alamat_bisnis = $request->alamat_bisnis;
        $bisnis->telp_bisnis = $request->telp_bisnis;
        $bisnis->akun_instagram = $request->akun_instagram;
        $bisnis->page_facebook = $request->page_facebook;
        $bisnis->email_bisnis = $request->email_bisnis;
        $bisnis->website_bisnis = $request->website_bisnis;
        $bisnis->foto_usaha = $photo ? $photo : $bisnis->foto_usaha;
        $bisnis->id_user = \Auth::user()->id_user;
        $bisnis->save();


        return redirect("akun_bisnis")->with('success', 'Berhasil mengedit kelas');
    }

    public function update_preneur(Request $request, UserPreneur $bisnis, $id)
    {
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'deskripsi_usaha' => 'required',
            'jumlah_karyawan' => 'required',
            'omset_bulanan' => 'required',
            'nama_bisnis' => 'required',
            'tahun_dirikan' => 'required',
            'bidang_usaha' => 'required',
            'industri' => 'required',
            'id_provinsi' => 'required',
            'alamat_bisnis' => 'required',
            'email_bisnis' => 'required',
            'telp_bisnis' => 'required',
            // 'akun_instagram'=>'required',
            // 'page_facebook'=>'required',
            // 'website_bisnis'=>'required',
            'foto_usaha' => 'max:5120',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        // dd($request->all());
        $photo = '';
        $file = request()->file('foto_usaha');
        if ($file) {
            $photo = $file->getClientOriginalName();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/bisnismember/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/bisnismember/', $photo);
            }
        }

        $bisnis = UserPreneur::where("id_user", $id)->first();
        $bisnis->deskripsi_usaha = $request->deskripsi_usaha;
        $bisnis->jumlah_karyawan = $request->jumlah_karyawan;
        $bisnis->omset_bulanan = $request->omset_bulanan;
        $bisnis->nama_bisnis = $request->nama_bisnis;
        $bisnis->tahun_dirikan = $request->tahun_dirikan;
        $bisnis->bidang_usaha = $request->bidang_usaha;
        $bisnis->industri = $request->industri;
        $bisnis->id_provinsi = $request->id_provinsi;
        $bisnis->alamat_bisnis = $request->alamat_bisnis;
        $bisnis->telp_bisnis = $request->telp_bisnis;
        $bisnis->akun_instagram = $request->akun_instagram;
        $bisnis->page_facebook = $request->page_facebook;
        $bisnis->email_bisnis = $request->email_bisnis;
        $bisnis->website_bisnis = $request->website_bisnis;
        $bisnis->foto_usaha = $photo ? $photo : $bisnis->foto_usaha;
        $bisnis->save();

        return redirect("akun_bisnis")->with('success', 'Berhasil mengedit kelas');
    }
}
