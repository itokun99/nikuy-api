<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Models\RiwayatAdmin;

class RiwayatAdminController extends Controller
{
    //
    public function index_page()
    {
        $riwayat = RiwayatAdmin::with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20)
            ->withQueryString();
        return view('admin.pages.riwayat.admin.index', [
            'riwayat' => $riwayat
        ]);
    }
    public function detail_page($id)
    {
        $riwayat = RiwayatAdmin::with(['user'])->find($id);

        if (!$riwayat) {
            return abort(404);
        }

        return view('admin.pages.riwayat.admin.detail', [
            'riwayat' => $riwayat
        ]);
    }
    public function delete($id)
    {
        $riwayat = RiwayatAdmin::find($id);

        if (!$riwayat) {
            return abort(404);
        }

        return redirect()
            ->back()
            ->with('success', 'Berhasil menghapus data');
    }
}
