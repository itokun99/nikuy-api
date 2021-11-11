<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaksi;
use App\Models\PaketMember;
use App\Models\User;
use App\Models\Kelas;
use Carbon\Carbon;


class DashboardController extends Controller
{
    //
    public function index_page()
    {
        $member = User::where(['status' => 'Aktif', 'hak_akses' => 'Member']);
        $transaksi = new Transaksi();
        $kelas = new Kelas();
        $paketMember = new PaketMember();
        $paketMember = $paketMember->where(['kondisi' => 'POSTING'])->get();

        foreach ($paketMember as $paket) {
            $paket->memberCount = User::where(['status' => 'Aktif', 'hak_akses' => 'Member', 'id_paket' => $paket->id_paket])->count();
        }

        $totalMember = $member->count();

        $totalNewMember = $member->where('created_at', Carbon::today())->count();
        $totalKelas = $kelas->count();
        $totalTransaksi = $transaksi->count();

        $transaksiTerbaru = $transaksi->orderBy('created_at', 'desc')->limit(5)->get();


        if ($transaksiTerbaru) {
            foreach ($transaksiTerbaru as $tx) {
                $tx->member = User::find($tx->id_user);
            }
        }


        return view('admin.pages.dashboard.index')->with([
            'totalNewMember' => $totalNewMember,
            'totalMember' => $totalMember,
            'totalKelas' => $totalKelas,
            'totalTransaksi' => $totalTransaksi,
            'paketMember' => $paketMember,
            'transaksiTerbaru' => $transaksiTerbaru
        ]);
        //
    }
}
