<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BannerKelas;
use App\Models\BannerKelasKursus;
use App\Models\Kursus;
use Illuminate\Support\Facades\Validator;

class BannerKelasKursusController extends Controller
{

    public function add(Request $request, $banner_id)
    {
        $banner = BannerKelas::find($banner_id);

        if (!$banner) {
            return redirect()->back()->withErrors([
                'message' => 'Banner Kelas sudah tidak tersedia / terhapus'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'id_kursus' => 'required',
            'order' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kursus = Kursus::where('id_kursus', $request->id_kursus)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$kursus) {
            return redirect()->back()->withErrors([
                'message' => 'Kursus yang dipilih tidak tersedia'
            ]);
        }

        if ($request->order <= 0) {
            return redirect()->back()->withErrors([
                'message' => 'urutan harus bernilai positif'
            ]);
        }

        $existing_order = BannerKelasKursus::where('order', $request->order)->first();

        if ($existing_order) {
            return redirect()->back()->withErrors([
                'message' => 'Urutan sudah digunakan item lain'
            ]);
        }

        $bannerKursus = BannerKelasKursus::create([
            'id_banner_kelas' => $banner->id,
            'id_kursus' => $kursus->id_kursus,
            'order' => $request->order,
            'kondisi' => $request->kondisi,
        ]);

        $this->logAdmin("Menambahkan kursus untuk banner $banner->judul", $bannerKursus);

        return redirect()->back()->with('success', 'Berhasil menyimpan data banner kursus');
    }
    public function edit(Request $request, $banner_id, $id)
    {
        // dd($request->kondisi);
        $banner = BannerKelas::find($banner_id);

        if (!$banner) {
            return redirect()->back()->withErrors([
                'message' => 'Banner Kelas sudah tidak tersedia / terhapus'
            ]);
        }

        $bannerKursus = BannerKelasKursus::find($id);

        if (!$bannerKursus) {
            return redirect()->back()->withErrors([
                'message' => 'Banner kursus tidak tersedia'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'id_kursus' => 'required',
            'order' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kursus = Kursus::where('id_kursus', $request->id_kursus)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$kursus) {
            return redirect()->back()->withErrors([
                'message' => 'Kursus yang dipilih tidak tersedia'
            ]);
        }

        if ($request->order <= 0) {
            return redirect()->back()->withErrors([
                'message' => 'urutan harus bernilai positif'
            ]);
        }

        $existing_order = BannerKelasKursus::where('order', $bannerKursus->order)->first();

        if ($existing_order && $existing_order->order != $bannerKursus->order) {
            $existing_order->order = $kursus->order;
            $bannerKursus->order = $request->order;
        } else {
            $bannerKursus->order = $request->order;
        }

        $bannerKursus->id_kursus = $kursus->id_kursus;
        $bannerKursus->id_banner_kelas = $banner->id;
        $bannerKursus->kondisi = $request->kondisi;
        $bannerKursus->save();
        $existing_order->save();

        $this->logAdmin("Mengedit kursus untuk banner $banner->judul", $bannerKursus);

        return redirect()->back()->with('success', 'Berhasil mengubah banner kursus');
    }

    public function delete($banner_id, $id)
    {
        $banner = BannerKelas::find($banner_id);

        if (!$banner) {
            return redirect()->back()->withErrors([
                'message' => 'Banner Kelas sudah tidak tersedia / terhapus'
            ]);
        }

        $bannerKursus = BannerKelasKursus::find($id);

        if (!$bannerKursus) {
            return redirect()->back()->withErrors([
                'message' => 'Banner kursus tidak tersedia'
            ]);
        }
        $this->logAdmin("Menghapus kursus untuk banner $banner->judul", $bannerKursus);
        $bannerKursus->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus banner kursus');
    }
}
