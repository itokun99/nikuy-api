<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketMember;
use App\Models\PaketKelas;
use App\Models\Kelas;
use Illuminate\Support\Facades\Validator;




class PaketKelasController extends Controller
{
    public function index_page()
    {
        $paket_kelas = PaketKelas::with(['kelas', 'paket'])->paginate(10);
        $paket_member = PaketMember::with(['paket_kelas.kelas.pilar'])->get();

        return view('admin.pages.kursus.pembagiankelas.index')->with(
            [
                "paketkelass" => $paket_kelas,
                'paket_member' => $paket_member,
            ]
        );
    }

    public function add_page()
    {
        $paket = PaketMember::whereIn('kondisi', ['POSTING'])->get();
        $kelas = Kelas::whereIn('kondisi', ['POSTING'])->orderBy('order_id', 'asc')->get();

        return view('admin.pages.kursus.pembagiankelas.form', [
            'paket_kelas' => NULL,
            'paket' => $paket,
            'kelas' => $kelas,
        ]);
    }

    public function edit_page($id = NULL)
    {

        $paket_kelas = PaketKelas::find($id);

        if (!$paket_kelas) {
            return abort(404);
        }

        $paket = PaketMember::all();
        $kelas = Kelas::all();

        return view('admin.pages.kursus.pembagiankelas.form', [
            'paket_kelas' => $paket_kelas,
            'paket' => $paket,
            'kelas' => $kelas,
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_paket' => 'required',
            'id_kelas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $paket = PaketMember::where('id_paket', $request->id_paket)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$paket) {
            return redirect()->back()->withErrors([
                'message' => 'Paket yang dipilih tidak tersedia'
            ]);
        }

        $kelas = Kelas::where('id_kelas', $request->id_kelas)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$kelas) {
            return redirect()->back()->withErrors([
                'message' => 'Kelas yang dipilih tidak tersedia'
            ]);
        }

        $existing = PaketKelas::where('id_kelas', $kelas->id_kelas)
            ->where('id_paket', $paket->id_paket)
            ->first();

        if ($existing) {
            return back()->withErrors([
                'message' => 'Pembagian kelas ini sudah ada'
            ]);
        }


        $paket_member = new PaketKelas;
        $paket_member->id_paket = $paket->id_paket;
        $paket_member->id_kelas = $kelas->id_kelas;
        $paket_member->save();

        $this->logAdmin("Menambahkan pembagian kelas $paket->nama_paket dan $kelas->nama_kelas", json_encode($paket_member));

        return redirect("/admin/pembagian-kelas")->with('success', 'Berhasil membuat pembagian kelas');
    }

    public function edit(Request $request, $id)
    {
        $paket_member = PaketKelas::find($id);

        if (!$paket_member) {
            return back()->withErrors([
                'message' => 'Paket Kelas tidak ditemukan'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'id_paket' => 'required',
            'id_kelas' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $paket = PaketMember::where('id_paket', $request->id_paket)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$paket) {
            return redirect()->back()->withErrors([
                'message' => 'Paket yang dipilih tidak tersedia'
            ]);
        }

        $kelas = Kelas::where('id_kelas', $request->id_kelas)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$kelas) {
            return redirect()->back()->withErrors([
                'message' => 'Kelas yang dipilih tidak tersedia'
            ]);
        }

        $existing = PaketKelas::where('id_kelas', $kelas->id_kelas)
            ->where('id_paket', $paket->id_paket)
            ->first();

        if ($existing) {
            if ($existing->id_kelas != $paket_member->id_kelas && $existing->id_paket != $paket_member->id_paket) {
                return back()->withErrors([
                    'message' => 'Pembagian kelas ini sudah ada'
                ]);
            }
        }


        $paket_member->id_paket = $paket->id_paket;
        $paket_member->id_kelas = $kelas->id_kelas;
        $paket_member->save();

        $this->logAdmin("Mengedit pembagian kelas $paket->nama_paket dan $kelas->nama_kelas", json_encode($paket_member));

        return redirect("/admin/pembagian-kelas")->with('success', 'Berhasil mengedit pembagian kelas');
    }

    public function delete($id)
    {
        $paket = PaketKelas::with(['paket', 'kelas'])->find($id);

        if (!$paket) {
            return abort(404);
        }

        $p = $paket->paket->nama_paket;
        $k = $paket->kelas->nama_kelas;

        $this->logAdmin("Menghapus pembagian kelas $p dan $k", json_encode($paket));

        $paket->delete();
        return redirect("/admin/pembagian-kelas")->with('success', 'Berhasil menghapus pembagian kelas');
    }
}
