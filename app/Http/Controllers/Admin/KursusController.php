<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kursus;
use App\Models\Pilar;
use App\Models\Kelas;
use App\Models\PaketMember;
use Illuminate\Support\Facades\Validator;


class KursusController extends Controller
{
    //
    public function index_page()
    {
        $kursus = Kursus::with(['paket', 'kelas', 'pilar'])
            ->orderBy('order_id', 'ASC')
            ->paginate(10);
        return view('admin.pages.kursus.index')->with(["kursuss" => $kursus]);
    }

    public function add_page()
    {
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.pages.kursus.form')->with(["kursus" => null, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function edit_page($id)
    {
        $kursus = Kursus::find($id);

        if (!$kursus) {
            return abort(404);
        }

        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.pages.kursus.form')->with(["kursus" => $kursus, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function detail_page($id = NULL)
    {
        $kursus = Kursus::with(['paket', 'kelas', 'pilar'])->find($id);
        if (!$kursus) {
            return abort(404);
        }

        return view('admin.pages.kursus.detail', [
            'kursus' => $kursus,
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_kursus' => 'required',
            'foto_kursus' => 'max:5120',
            'id_pilar' => 'required',
            'id_paket' => 'required',
            'id_kelas' => 'required',
            'order_id' => 'required',
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

        $existing = Kursus::where('id_paket', $paket->id_paket)
            ->where('id_kelas', $kelas->id_kelas)
            ->where('id_pilar', $pilar->id_pilar)
            ->where('nama_kursus', $request->nama_kursus)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors([
                "message" => "Nama kursus sudah digunakan pada kursus lain dengan paket, kelas, dan pilar yang sama"
            ]);
        }

        $existing = Kursus::where('order_id', $request->order_id)
            ->first();

        if ($existing) {
            return redirect()->back()->withErrors([
                "message" => "Urutan sudah digunakan pada kursus lain dengan paket, kelas, dan pilar yang sama"
            ]);
        }

        $photo = NULL;
        $file = request()->file('foto_kursus');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/kursus');
        }

        $kursus = new kursus;
        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->deskripsi = $request->deskripsi;
        $kursus->foto_kursus = $photo;
        $kursus->id_pilar = $pilar->id_pilar;
        $kursus->id_paket = $paket->id_paket;
        $kursus->id_kelas = $kelas->id_kelas;
        $kursus->order_id = $request->order_id;
        $kursus->kondisi = $request->kondisi;
        $kursus->save();


        $this->logAdmin("Menambahkan Kursus $kursus->nama_kursus", json_encode($kursus));

        return redirect("/admin/kursus")->with('success', 'Berhasil membuat kursus');
    }

    public function edit(Request $request, $id)
    {
        $kursus = kursus::find($id);

        if (!$kursus) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_kursus' => 'required',
            'foto_kursus' => 'max:5120',
            'id_pilar' => 'required',
            'id_paket' => 'required',
            'id_kelas' => 'required',
            'order_id' => 'required',
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

        $existing = Kursus::where('order_id', $request->order_id)->first();

        if ($existing && $existing->order_id != $kursus->order_id) {
            $existing->order_id = $kursus->order_id;
            $kursus->order_id = $request->order_id;
        } else {
            $kursus->order_id = $request->order_id;
        }

        $photo = NULL;
        $prevFile = NULL;
        $file = request()->file('foto_kursus');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/kursus');
            $prevFile = $kursus->foto_kursus;
            $kursus->foto_kursus = $photo;
        }


        $kursus->nama_kursus = $request->nama_kursus;
        $kursus->deskripsi = $request->deskripsi;
        $kursus->id_pilar = $request->id_pilar;
        $kursus->id_paket = $request->id_paket;
        $kursus->id_kelas = $request->id_kelas;
        $kursus->kondisi = $request->kondisi;
        $kursus->save();
        $existing->save();

        if ($photo && $prevFile) {
            $this->deleteFile($prevFile, 'assets/foto/kursus');
        }

        $this->logAdmin("Mengedit Kursus $kursus->nama_kursus", json_encode($kursus));

        return redirect("/admin/kursus")->with('success', 'Berhasil mengedit kursus');
    }

    public function delete($id)
    {
        $kursus = Kursus::find($id);

        if (!$kursus) {
            return abort(404);
        }

        if ($kursus->foto_kursus) {
            $this->deleteFile($kursus->foto_kursus, 'assets/foto/kursus');
        }

        $this->logAdmin("Menghapus Kursus $kursus->nama_kursus", json_encode($kursus));

        $kursus->delete();
        return redirect("/admin/kursus")->with('success', 'Berhasil menghapus kursus');
    }
}
