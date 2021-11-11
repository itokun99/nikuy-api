<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use Illuminate\Support\Facades\Validator;

class ProvinsiController extends Controller
{
    public function index_page()
    {
        $prov = Provinsi::all();
        return view('admin.pages.setting.dataprovinsi.index')->with(["provinsi" => $prov]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_provinsi' => 'required|unique:provinsi',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $provinsi = Provinsi::create([
            'nama_provinsi' => $request->nama_provinsi
        ]);


        $this->logAdmin("Menambah provinsi $provinsi->nama_provinsi", json_encode($provinsi));

        return redirect()->back()->with('success', "Berhasil menambahkan provinsi $provinsi->nama_provinsi");
    }

    public function edit(Request $request, $id)
    {
        $provinsi = Provinsi::find($id);

        if (!$provinsi) {
            return redirect()->back()->withErrors(['message' => 'Provinsi tidak ditemukan']);
        }

        $validator = Validator::make($request->all(), [
            'nama_provinsi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $existing = Provinsi::where('nama_provinsi', $request->nama_provinsi)->first();

        if ($existing && $existing->nama_provinsi != $provinsi->nama_provinsi) {
            return redirect()->back()->withErrors(['message' => "$request->nama_provinsi sudah ada dalam daftar"]);
        }

        $provinsi->update([
            'nama_provinsi' => $request->nama_provinsi
        ]);

        $this->logAdmin("Mengedit provinsi $provinsi->nama_provinsi", json_encode($provinsi));

        return redirect()->back()->with('success', "Berhasil mengedit provinsi $provinsi->nama_provinsi");
    }

    public function delete($id)
    {
        $provinsi = Provinsi::find($id);

        if (!$provinsi) {
            return abort(404);
        }

        $this->logAdmin("Menghapus provinsi $provinsi->nama_provinsi", json_encode($provinsi));

        $provinsi->delete();

        return redirect()->back()->with('success', "Berhasil menghapus provinsi $provinsi->nama_provinsi");
    }
}
