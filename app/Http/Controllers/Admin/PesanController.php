<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KontakKami;

class PesanController extends Controller
{
    //
    public function index_page()
    {
        $pesan = KontakKami::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.pages.pesan.index', [
            'pesan' => $pesan,
        ]);
    }
    public function detail_page($id)
    {
        $pesan = KontakKami::find($id);

        if (!$pesan) {
            return abort(404);
        }

        $pesan->status = 'dibaca';
        $pesan->save();

        $this->logAdmin("Membaca Pesan dari email $pesan->email dengan subyek $pesan->subyek", json_encode($pesan));
        return view('admin.pages.pesan.detail', ['pesan' => $pesan]);
    }

    public function delete($id)
    {
        $pesan = KontakKami::find($id);

        if (!$pesan) {
            return abort(404);
        }

        $this->logAdmin("Menghapus Pesan dari email $pesan->email dengan subyek $pesan->subyek", json_encode($pesan));
        $pesan->delete();

        return redirect()->back()->with('success', 'Berhasil henghapus pesan');
    }
}
