<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KursusFile;
use App\Models\Pilar;
use App\Models\PaketMember;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;

class FileKursusController extends Controller
{
    public function index_page()
    {
        $kursus = KursusFile::with(['paket', 'kelas', 'pilar'])
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->paginate(10);

        return view('admin.pages.kursus.file.index')->with(["kursuss" => $kursus]);
    }

    public function add_page()
    {
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.pages.kursus.file.form')->with(["kursus" => null, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function edit_page($id)
    {
        $kursus = KursusFile::findorfail($id);
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.pages.kursus.file.form')->with(["kursus" => $kursus, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kursus' => 'required',
            'file_kursus' => 'required|max:5120',
            'id_pilar' => 'required',
            'id_paket' => 'required',
            'id_kelas' => 'required',
            'order_id' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        if ($request->order_id <= 0) {
            return redirect()->back()->withErrors([
                'message' => "Nomor Urutan harus bernilai positif, dimulai dari Urutan 1 dan seterusnya"
            ]);
        }

        $paket = PaketMember::find($request->id_paket);
        if (!$paket) {
            return redirect()->back()->withErrors([
                "message" => "Paket yang dipilih tidak ditemukan"
            ]);
        }

        $kelas = Kelas::find($request->id_kelas);
        if (!$kelas) {
            return redirect()->back()->withErrors([
                "message" => "Kelas yang dipilih tidak ditemukan"
            ]);
        }

        $pilar = Pilar::find($request->id_pilar);
        if (!$pilar) {
            return redirect()->back()->withErrors([
                "message" => "Pilar yang dipilih tidak ditemukan"
            ]);
        }

        $existing = KursusFile::where('id_paket', $paket->id_paket)
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_pilar', $pilar->id_pilar)
            ->where('nama_kursus', $request->nama_kursus)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors([
                "message" => "Nama sudah digunakan pada kursus lain dengan paket, kelas, dan pilar yang sama"
            ]);
        }

        $existing = KursusFile::where('id_paket', $paket->id_paket)
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_pilar', $pilar->id_pilar)
            ->where('order_id', $request->order_id)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors([
                "message" => "Urutan sudah digunakan pada kursus lain dengan paket, kelas, dan pilar yang sama"
            ]);
        }


        $file_kursus = NULL;
        $file = request()->file('file_kursus');
        if ($file) {
            $file_kursus = $this->uploadFile($file, 'assets/file/kursus');
        }

        $kursus = new KursusFile;
        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->file_kursus = $file_kursus;

        $kursus->id_pilar = $pilar->id_pilar;
        $kursus->id_paket = $paket->id_paket;
        $kursus->id_kelas = $kelas->id_kelas;
        $kursus->order_id = $request->order_id;
        $kursus->kondisi = $request->kondisi;
        $kursus->save();


        $this->logAdmin("Memambahkan File Kursus $kursus->nama_kursus", json_encode($kursus));

        return redirect("/admin/file-kursus")->with('success', 'Berhasil membuat kursus');
    }

    public function edit(Request $request, $id)
    {
        $kursus = KursusFile::find($id);

        if (!$kursus) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kursus' => 'required',
            'file_kursus' => 'max:5120',
            'id_pilar' => 'required',
            'id_paket' => 'required',
            'id_kelas' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->order_id <= 0) {
            return redirect()->back()->withErrors([
                'message' => "Nomor Urutan harus bernilai positif, dimulai dari Urutan 1 dan seterusnya"
            ]);
        }

        $paket = PaketMember::find($request->id_paket);
        if (!$paket) {
            return redirect()->back()->withErrors([
                "message" => "Paket yang dipilih tidak ditemukan"
            ]);
        }

        $kelas = Kelas::find($request->id_kelas);
        if (!$kelas) {
            return redirect()->back()->withErrors([
                "message" => "Kelas yang dipilih tidak ditemukan"
            ]);
        }

        $pilar = Pilar::find($request->id_pilar);
        if (!$pilar) {
            return redirect()->back()->withErrors([
                "message" => "Pilar yang dipilih tidak ditemukan"
            ]);
        }

        $existing = KursusFile::where('id_paket', $paket->id_paket)
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_pilar', $pilar->id_pilar)
            ->where('order_id', $request->order_id)
            ->first();

        if ($existing && $existing->order_id != $kursus->order_id) {
            $existing->order_id = $kursus->order_id;
            $kursus->order_id = $request->order_id;
        } else {
            $kursus->order_id = $request->order_id;
        }

        $file_kursus = NULL;
        $prevFile = NULL;
        $file = request()->file('file_kursus');
        if ($file) {
            $file_kursus = $this->uploadFile($file, 'assets/file/kursus');

            $prevFile = $kursus->file_kursus;
            $kursus->file_kursus = $file_kursus;
        }

        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->id_pilar = $pilar->id_pilar;
        $kursus->id_paket = $paket->id_paket;
        $kursus->id_kelas = $kelas->id_kelas;
        $kursus->kondisi = $request->kondisi;
        $kursus->save();

        if ($file_kursus && $prevFile) {
            $this->deleteFile($prevFile, 'assets/file/kursus');
        }

        $this->logAdmin("Mengedit File Kursus $kursus->nama_kursus", json_encode($kursus));

        return redirect("/admin/file-kursus")->with('success', 'Berhasil mengedit kursus');
    }

    public function delete($id)
    {
        $kursus = KursusFile::find($id);

        if (!$kursus) {
            return redirect("/admin/file-kursus")->withErrors([
                "message" => 'Gagal menghapus kursus'
            ]);
        }

        if ($kursus->file_kursus) {
            $this->deleteFile($kursus->file_kursus, 'assets/file/kursus');
        }

        $this->logAdmin("Menghapus File Kursus $kursus->nama_kursus", json_encode($kursus));
        $kursus->delete();
        return redirect("/admin/file-kursus")->with('success', 'Berhasil menghapus kursus');
    }

    public function download($id)
    {
        $kursus = KursusFile::where('id_kursus', $id)
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->first();
        if (!$kursus) {
            return abort(404);
        }
        $file = $this->getPublicPath() . 'assets/file/kursus' . '/' . $kursus->file_kursus;
        return response()->download($file);
    }
}
