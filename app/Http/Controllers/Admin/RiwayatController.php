<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Riwayat;

class RiwayatController extends Controller
{
    //
    public function index_page()
    {
        $riwayat = Riwayat::with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.pages.riwayat.member.index', [
            'riwayat' => $riwayat
        ]);
    }
    public function detail_page($id)
    {
        $riwayat = Riwayat::with(['user'])->find($id);

        if (!$riwayat) {
            return abort(404);
        }

        return view('admin.pages.riwayat.member.detail', [
            'riwayat' => $riwayat
        ]);
    }
    public function delete($id)
    {
        $riwayat = Riwayat::find($id);

        if (!$riwayat) {
            return abort(404);
        }

        return redirect()
            ->back()
            ->with('success', 'Berhasil menghapus data');
    }
}
