<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Pilar;
use App\Models\Kelas;
use App\Models\User;
use App\Models\EventDaftar;
use App\Models\PaketMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{

    public function transaksidiproses()
    {
        $transaksi = Transaksi::where('keterangan', 'Ok')->get();
        return view('admin.pages.transaksi.diproses')->with(["transaksidiproses" => $transaksi]);
    }

    public function expired()
    {
        $expireds = Transaksi::where('keterangan', 'Expired')->get();
        return view('admin.pages.transaksi.expired')->with(["expired" => $expireds]);
    }

    public function belum_diproses()
    {
        $waiting = Transaksi::where('keterangan', 'Menunggu')->get();
        return view('admin.pages.transaksi.index')->with(["transaksi" => $waiting]);
    }



    public function tambah_transaksi()
    {
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.tambah_transaksi')->with(["transaksi" => null, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function edit($id)
    {
        $transaksi = Transaksi::findorfail($id);
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.tambah_transaksi')->with(["transaksi" => $transaksi, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function user_transaksi()
    {
        $transaksi = transaksi::where("id_user", \Auth::user()->id_user)->get();

        return view('transaksi')->with(["transaksi" => $transaksi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'alt' => 'required',
            'foto_transaksi' => 'required|max:5120',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $photo = '';
        $file = request()->file('foto_transaksi');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/transaksi/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/transaksi/', $photo);
            }
        }

        $transaksi = new Transaksi;
        $transaksi->alt = $request->alt;
        $transaksi->foto_transaksi = $photo;
        $transaksi->save();

        return redirect("/admin/transaksi")->with('success', 'Berhasil membuat transaksi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(transaksi $transaksi)
    {
        $paket = $paket_member::find($id);
        return view('admin.tambah_membership')->with(['paket' => $paket]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaksi $transaksi, $id)
    {
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'alt' => 'required',
            'foto_transaksi' => 'max:5120',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $photo = '';
        $file = request()->file('foto_transaksi');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/transaksi/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/transaksi/', $photo);
            }
        }

        $transaksi = Transaksi::findorfail($id);
        $transaksi->foto_transaksi = $photo ? $photo : $transaksi->foto_transaksi;
        $transaksi->alt = $request->alt;
        $transaksi->save();

        return redirect("/admin/transaksi")->with('success', 'Berhasil mengedit transaksi');
    }
}
