<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pilar;
use App\Models\Kelas;
use App\Models\Kursus;
use Illuminate\Support\Facades\Validator;


class PilarController extends Controller
{
    public function index_page()
    {
        $pilar = Pilar::with(['kelas', 'kursus'])
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->orderBy('order_id', 'ASC')
            ->paginate(10);
        return view(
            'admin.pages.kursus.pilar.index',
            ["pilar" => $pilar]
        );
    }

    public function add_page()
    {
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        return view('admin.pages.kursus.pilar.form')->with(["pilar" => null, 'kelas' => $kelas]);
    }

    public function edit_page($id)
    {
        $pilar = pilar::find($id);

        if (!$pilar) {
            return abort(404);
        }

        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        return view('admin.pages.kursus.pilar.form')->with(["pilar" => $pilar, 'kelas' => $kelas]);
    }

    public function detail_page($id = NULL)
    {
        $pilar = Pilar::with(['kelas'])->find($id);

        if (!$pilar) {
            return abort(404);
        }

        $kursus = Kursus::where('id_pilar', $id);

        $jumlahPelajaran = $kursus->count();

        $kursus = $kursus->paginate(10);

        return view('admin.pages.kursus.pilar.detail', [
            'pilar' => $pilar,
            'kursus' => $kursus,
            'jumlahPelajaran' => $jumlahPelajaran
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_pilar' => 'required|unique:pilar',
            'desk_pilar' => 'required',
            'id_kelas' => 'required',
            'order_id' => 'required|unique:pilar',
            'kondisi' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kelas = Kelas::find($request->id_kelas);

        if (!$kelas) {
            return redirect()->back()->withErrors([
                'message' => 'Kelas yang dipilih tidak ditemukan'
            ]);
        }

        $pilar = new pilar;
        $pilar->nama_pilar = $request->nama_pilar;
        $pilar->desk_pilar = $request->desk_pilar;
        $pilar->id_kelas = $kelas->id_kelas;
        $pilar->order_id = $request->order_id;
        $pilar->kondisi = $request->kondisi;
        $pilar->save();

        $this->logAdmin("Menambahkan Pilar $pilar->nama_pilar", json_encode($pilar));

        return redirect("/admin/pilar")->with('success', 'Berhasil membuat pilar');
    }

    public function edit(Request $request, $id)
    {

        $pilar = Pilar::find($id);

        if (!$pilar) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_pilar' => 'required',
            'desk_pilar' => 'required',
            'id_kelas' => 'required',
            'order_id' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->order_id <= 0) {
            return redirect()->back()->withErrors([
                'message' => 'Urutan harus nilai positif dimulai dari 1 dan seterusnya'
            ]);
        }


        $existing = Pilar::where('nama_pilar', $request->nama_pilar)->first();

        if ($existing && $existing->nama_pilar != $pilar->nama_pilar) {
            return redirect()->back()->withErrors([
                'message' => 'Nama pilar sudah ada'
            ]);
        }

        $existing = Pilar::where('order_id', $request->order_id)->first();

        if ($existing && $existing->order_id != $pilar->order_id) {
            $existing->order_id = $pilar->order_id;
            $pilar->order_id = $request->order_id;
        } else {
            $pilar->order_id = $request->order_id;
        }

        $kelas = Kelas::find($request->id_kelas);
        if (!$kelas) {
            return redirect()->back()->withErrors([
                'message' => 'Kelas yang dipilih tidak ditemukan'
            ]);
        }


        $pilar->nama_pilar = $request->nama_pilar;
        $pilar->desk_pilar = $request->desk_pilar;
        $pilar->id_kelas = $kelas->id_kelas;
        $pilar->kondisi = $request->kondisi;
        $pilar->save();

        $this->logAdmin("Mengedit Pilar $pilar->nama_pilar", json_encode($pilar));

        return redirect("/admin/pilar")->with('success', 'Berhasil mengedit pilar');
    }

    public function delete($id)
    {
        $pilar = Pilar::with(['kursus'])->find($id);
        if (!$pilar) {
            return abort(404);
        }

        if ($pilar->kursus && count($pilar->kursus) > 0) {
            return redirect()->back()->withErrors(['message' => "Tidak bisa menghapus pilar $pilar->nama_pilar, karena memiliki pelajaran. Ubah terlebih dahulu pelajaran yang terikat dengan pilar ini"]);
        }

        $this->logAdmin("Menghapus Pilar $pilar->nama_pilar", json_encode($pilar));

        $pilar->delete();
        return redirect("/admin/pilar")->with('success', "Berhasil menghapus pilar");
    }
}
