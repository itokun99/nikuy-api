<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Kursus;
use Illuminate\Support\Facades\Validator;



class KelasController extends Controller
{
    //
    public function index_page()
    {
        $kelas = Kelas::with(['kursus'])
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->orderBy('order_id', 'ASC')
            ->paginate(10);
        return view('admin.pages.kursus.kelas.index')->with(["kelass" => $kelas]);
    }

    public function add_page()
    {
        return view('admin.pages.kursus.kelas.form')->with(["kelas" => null]);
    }

    public function edit_page($id)
    {
        $kelas = Kelas::findorfail($id);
        return view('admin.pages.kursus.kelas.form')->with(["kelas" => $kelas]);
    }

    public function detail_page($id)
    {
        $kelas = Kelas::with(['kursus'])->find($id);

        if (!$kelas) {
            return abort(404);
        }

        $kursus = Kursus::where('id_kelas', $id);

        $jumlahPelajaran = $kursus->count();
        $kursus = $kursus->paginate(10);

        return view('admin.pages.kursus.kelas.detail', [
            'kelas' => $kelas,
            'jumlahPelajaran' => $jumlahPelajaran,
            'kursus' => $kursus,
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required|unique:kelas',
            'order_id' => 'required|unique:kelas',
            'deskripsi' => 'required',
            'foto_kelas' => 'required|max:5120',
            'pesan' => 'required',
            'kondisi' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $photo = NULL;
        $file = request()->file('foto_kelas');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/kelas');
        }

        $kelas = new kelas;
        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->order_id = $request->order_id;
        $kelas->deskripsi = $request->deskripsi;
        $kelas->foto_kelas = $photo;
        $kelas->pesan = $request->pesan;
        $kelas->kondisi = $request->kondisi;
        $kelas->save();

        $this->logAdmin("Memambahkan Kelas $kelas->nama_kelas", json_encode($kelas));

        return redirect("/admin/kelas")->with('success', 'Berhasil membuat kelas');
    }

    public function edit(Request $request, $id)
    {

        $kelas = Kelas::find($id);

        if (!$kelas) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'order_id' => 'required',
            'foto_kelas' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->order_id <= 0) {
            return redirect()->back()->withErrors([
                'message' => "Nomor Urutan harus bernilai positif, dimulai dari Urutan 1 dan seterusnya"
            ]);
        }

        $existing = Kelas::where('nama_kelas', $request->nama_kelas)->first();

        if ($existing && $kelas->nama_kelas != $existing->nama_kelas) {
            return redirect()->back()->withErrors([
                'message' => "Nama kelas sudah digunakan di kelas yang lain"
            ]);
        }

        $existing = Kelas::where('order_id', $request->order_id)->first();

        if ($existing && $existing->order_id != $kelas->order_id) {
            $existing->order_id = $kelas->order_id;
            $kelas->order_id = $request->order_id;
            $existing->save();
        } else {
            $kelas->order_id = $request->order_id;
        }

        $photo = NULL;
        $prevFoto = NULL;
        $file = request()->file('foto_kelas');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/kelas');
            $prevFoto = $kelas->foto_kelas;
            $kelas->foto_kelas = $photo;
        }

        $kelas->nama_kelas = $request->nama_kelas;
        $kelas->order_id = $request->order_id;
        $kelas->deskripsi = $request->deskripsi;
        $kelas->pesan = $request->pesan;
        $kelas->kondisi = $request->kondisi;
        $kelas->save();

        if ($photo && !$prevFoto) {
            $this->deleteFile($prevFoto, 'assets/foto/kelas');
        }

        $this->logAdmin("Mengedit Kelas $kelas->nama_kelas", json_encode($kelas));

        return redirect("/admin/kelas")->with('success', 'Berhasil mengedit kelas');
    }

    public function delete($id)
    {
        $kelas = Kelas::with(['kursus', 'paket_kelas', 'pilar'])->find($id);

        if (!$kelas) {
            return abort(404);
        }

        if ($kelas->kursus && count($kelas->kursus) > 0) {
            return redirect()->back()->withErrors(['message' => "Tidak bisa menghapus $kelas->nama_kelas, karena masih ada pelajaran yang terkait. Ubah terlebih dahulu pelajaran yang terikat dengan kelas ini"]);
        }

        if ($kelas->paket_kelas && count($kelas->paket_kelas) > 0) {
            return redirect()->back()->withErrors(['message' => "Tidak bisa menghapus $kelas->nama_kelas, karena terikat dengan pembagian kelas, Hapus terlebih terlebih dahulu pembagian kelas untuk kelas ini"]);
        }

        if ($kelas->pilar && count($kelas->paket_kelas) > 0) {
            return redirect()->back()->withErrors(['message' => "Tidak bisa menghapus $kelas->nama_kelas, karena terikat dengan pilar. Ubah terlebih dahulu pilar yang terikat dengan kelas ini"]);
        }

        if ($kelas->foto_kelas) {
            $this->deleteFile($kelas->foto_kelas, 'assets/foto/kelas');
        }

        $this->logAdmin("Menghapus Kelas $kelas->nama_kelas", json_encode($kelas));

        $kelas->delete();
        return redirect("/admin/kelas")->with('success', 'Berhasil menghapus kelas');
    }
}
