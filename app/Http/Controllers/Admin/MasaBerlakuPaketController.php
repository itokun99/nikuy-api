<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasaBerlakuPaket;
use Illuminate\Support\Facades\Validator;

class MasaBerlakuPaketController extends Controller
{
    //
    public function index_page()
    {
        $masa_berlaku = MasaBerlakuPaket::all();
        return view('admin.pages.setting.masaberlaku.index', [
            'masa_berlaku' => $masa_berlaku
        ]);
    }

    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'tipe_masa' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            if (!$request->jumlah_masa && $request->tipe_masa != 'Free' && $request->tipe_masa != 'Selamanya') {
                return redirect()->back()->withErrors([
                    'message' => "Jumlah masa harus di isi untuk tipe masa $request->tipe_masa"
                ]);
            }

            $masa_berlaku = MasaBerlakuPaket::create([
                'jumlah_masa' => $request->jumlah_masa ? $request->jumlah_masa : NULL,
                'tipe_masa' => $request->tipe_masa,
                'status' => $request->status,
            ]);

            if (!$masa_berlaku) {
                return redirect()->back()->withErrors(['message' => 'Gagal meyimpan data']);
            }


            $mb = '';

            if ($masa_berlaku->tipe_masa == 'Free' || $masa_berlaku->tipe_masa == 'Selamanya') {
                $mb = $masa_berlaku->tipe_masa;
            } else {
                $mb = $masa_berlaku->jumlah_masa . " " . $masa_berlaku->tipe_masa;
            }

            $this->logAdmin("Menambahkan Masa Berlaku $mb", json_encode($masa_berlaku));

            return redirect()->back()->with('success', 'Berhasil menyimpan data');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    public function edit(Request $request, $id)
    {
        try {

            $masa_berlaku = MasaBerlakuPaket::find($id);

            if (!$masa_berlaku) {
                return redirect()->back()->withErrors(['message' => 'Data tidak ditemukan']);
            }


            $validator = Validator::make($request->all(), [
                'tipe_masa' => 'required',
                'status' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            if (!$request->jumlah_masa && $request->tipe_masa != 'Free' && $request->tipe_masa != 'Selamanya') {
                return redirect()->back()->withErrors([
                    'message' => "Jumlah masa harus di isi untuk tipe masa $request->tipe_masa"
                ]);
            }

            if ($request->jumlah_masa < 0) {
                return redirect()->back()->withErrors([
                    'message' => "Jumlah harus angka positif"
                ]);
            }

            $masa_berlaku->tipe_masa = $request->tipe_masa;
            $masa_berlaku->status = $request->status;

            if ($request->jumlah_masa) {
                $masa_berlaku->jumlah_masa = $request->jumlah_masa;
            }

            $masa_berlaku->save();


            $mb = '';

            if ($masa_berlaku->tipe_masa == 'Free' || $masa_berlaku->tipe_masa == 'Selamanya') {
                $mb = $masa_berlaku->tipe_masa;
            } else {
                $mb = $masa_berlaku->jumlah_masa . " " . $masa_berlaku->tipe_masa;
            }

            $this->logAdmin("Mengedit Masa Berlaku $mb", json_encode($masa_berlaku));

            return redirect()->back()->with('success', 'Berhasil menyimpan data');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['message' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        $masa_berlaku = MasaBerlakuPaket::find($id);

        if (!$masa_berlaku) {
            return redirect()->back()->withErrors(['message' => 'Data tidak ditemukan']);
        }

        $mb = '';

        if ($masa_berlaku->tipe_masa == 'Free' || $masa_berlaku->tipe_masa == 'Selamanya') {
            $mb = $masa_berlaku->tipe_masa;
        } else {
            $mb = $masa_berlaku->jumlah_masa . " " . $masa_berlaku->tipe_masa;
        }

        $this->logAdmin("Menghapus Masa Berlaku $mb", json_encode($masa_berlaku));

        $masa_berlaku->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
