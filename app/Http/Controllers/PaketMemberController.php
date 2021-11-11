<?php

namespace App\Http\Controllers;

use App\Models\PaketMember;
use App\Models\Transaksi;

class PaketMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function membership()
    {
        $memberss = PaketMember::all();
        return view('web.pages.membership.index')->with(["members" => $memberss]);
    }

    public function upgrade_membership($id_paketmember)
    {
        $paket = PaketMember::find($id_paketmember);

        return view('upgrade_membership')->with(["paket" => $paket]);
    }

    public function confirm_membership($id_paketmember)
    {
        $request = request();
        $timenow = \Carbon\Carbon::now();

        $photo = '';
        $file = request()->file('foto');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/struk/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/struk/', $photo);
            }
        }

        $transaksi = new Transaksi;
        $transaksi->nama_transaksi = $request->transaksi;
        $transaksi->no_rek = $request->norek;
        $transaksi->bank_asal = $request->bank;
        $transaksi->nama_rekening = $request->nama;
        $transaksi->tgl_transaksi = \Carbon\Carbon::now()->format("Y-m-d");
        $transaksi->id_paket = $id_paketmember;
        $transaksi->nama_transaksi = $request->transaksi;
        $transaksi->id_user = \Auth::user()->id_user;
        $transaksi->biaya_transaksi = $request->harga;
        $transaksi->keterangan = "Menunggu";
        $transaksi->baca_admin = "Sudah dibaca";
        $transaksi->baca_member = "Sudah dibaca";
        $transaksi->foto_struk = $photo;
        $transaksi->tgl_berakhir = \Carbon\Carbon::now()->addDays(2)->format("Y-m-d");
        $transaksi->save();

        return redirect("/transaksi");
    }
}
