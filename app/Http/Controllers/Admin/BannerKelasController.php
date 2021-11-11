<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Kelas;
use App\Models\BannerKelas;
use App\Models\BannerKelasKursus;
use App\Models\Kursus;
use App\Helper\Helper;


class BannerKelasController extends Controller
{

    public function edit_page($id)
    {
        $banner = BannerKelas::with(['kelas'])->find($id);

        if (!$banner) {
            return abort(404);
        }

        $kelas = Kelas::whereIn('kondisi', ['POSTING'])->orderBy('order_id')->get();

        $kursus = Kursus::whereIn('kondisi', ['POSTING'])
            ->orderBy('order_id', 'ASC')
            ->get();


        $bannerKursus = BannerKelasKursus::with(['kursus'])
            ->where('id_banner_kelas', $banner->id)
            ->orderBy('order', 'asc')
            ->get();

        return view('admin.pages.setting.slider.bannerkelas.form', [
            'kursus' => $kursus,
            'banner' => $banner,
            'kelas' => $kelas,
            'bannerKursus' => $bannerKursus
        ]);
    }

    public function add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'id_kelas' => 'required',
                'judul' => 'required',
                'kondisi' => 'required',
                'gambar' => 'required|max:5120',
                'order' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $kelas = Kelas::where('id_kelas', $request->id_kelas)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            if (!$kelas) {
                return redirect()->back()->withErrors([
                    'message' => 'kelas yang dipilih tidak tersedia'
                ]);
            }

            if ($request->order <= 0) {
                return redirect()->back()->withErrors([
                    'message' => 'urutan harus bernilai positif'
                ]);
            }


            $existing_order = BannerKelas::where('order', $request->order)->first();

            if ($existing_order) {
                return redirect()->back()->withErrors([
                    'message' => 'urutan sudah digunakan item lain,mohon isi urutan berbeda!'
                ]);
            }

            $gambar = NULL;
            $file = request()->file('gambar');

            if ($file) {
                $gambar = $this->uploadFile($file, 'assets/foto/slider');
            }

            $bannerKelas = BannerKelas::create([
                'judul' => $request->judul,
                'id_kelas' => $kelas->id_kelas,
                'order' => $request->order,
                'kondisi' => $request->kondisi,
                'gambar' => $gambar
            ]);


            if ($bannerKelas) {
                $kursus = Kursus::where('id_kelas', $kelas->id_kelas)
                    ->whereIn('kondisi', ['POSTING'])
                    ->orderBy('order_id', 'asc')
                    ->get();

                if ($kursus && count($kursus) > 0) {
                    $order = 1;
                    $bathData = [];
                    $created_at = Helper::getTimeNow();
                    $updated_at = $created_at;

                    foreach ($kursus as $k) {
                        array_push($bathData, [
                            'id_banner_kelas' => $bannerKelas->id,
                            'id_kursus' => $k->id_kursus,
                            'order' => $order,
                            'kondisi' => 'POSTING',
                            'created_at' => $created_at,
                            'updated_at' => $updated_at,
                        ]);

                        $order++;
                    }

                    if ($bathData && count($bathData) > 0) {
                        BannerKelasKursus::insert($bathData);
                    }
                }
            }

            $this->logAdmin("Menambahkan banner kelas $bannerKelas->judul", $bannerKelas);

            return redirect()->back()->with('success', 'Berhasil menambah data banner kelas');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function edit(Request $request, $id)
    {

        $banner = BannerKelas::find($id);

        if (!$banner) {
            return redirect()->back()->withErrors([
                'message' => 'Banner kelas tidak tersedia / terhapus'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'id_kelas' => 'required',
            'judul' => 'required',
            'kondisi' => 'required',
            'gambar' => 'max:5120',
            'order' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $kelas = Kelas::where('id_kelas', $request->id_kelas)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$kelas) {
            return redirect()->back()->withErrors([
                'message' => 'kelas yang dipilih tidak tersedia'
            ]);
        }

        if ($request->order <= 0) {
            return redirect()->back()->withErrors([
                'message' => 'urutan harus bernilai positif'
            ]);
        }

        $existing_order = BannerKelas::where('order', $request->order)->first();

        if ($existing_order && $existing_order->order != $banner->order) {
            $existing_order->order = $banner->order;
            $banner->order = $request->order;
        } else {
            $banner->order = $request->order;
        }

        $gambar = NULL;
        $prevFile = NULL;
        $file = request()->file('gambar');

        if ($file) {
            $gambar = $this->uploadFile($file, Helper::getAssetPath('banner'));
            $prevFile = $banner->gambar;
            $banner->gambar = $gambar;
        }

        if ($kelas->id_kelas != $banner->id_kelas) {

            BannerKelasKursus::where('id_banner_kelas', $banner->id)->delete();

            $kursus = Kursus::where('id_kelas', $kelas->id_kelas)
                ->whereIn('kondisi', ['POSTING'])
                ->orderBy('order_id', 'asc')
                ->get();

            if ($kursus && count($kursus) > 0) {
                $order = 1;
                $bathData = [];
                $created_at = Helper::getTimeNow();
                $updated_at = $created_at;

                foreach ($kursus as $k) {
                    array_push($bathData, [
                        'id_banner_kelas' => $banner->id,
                        'id_kursus' => $k->id_kursus,
                        'order' => $order,
                        'kondisi' => 'POSTING',
                        'created_at' => $created_at,
                        'updated_at' => $updated_at,
                    ]);

                    $order++;
                }

                if ($bathData && count($bathData) > 0) {
                    BannerKelasKursus::insert($bathData);
                }
            }
        }

        $banner->judul = $request->judul;
        $banner->id_kelas = $kelas->id_kelas;
        $banner->kondisi = $request->kondisi;
        $banner->save();
        $existing_order->save();

        if ($gambar && $prevFile) {
            $this->deleteFile($prevFile, Helper::getAssetPath('banner'));
        }

        return redirect()->back()->with('success', 'Berhasil mengedit data banner kelas');
    }

    public function delete($id)
    {
        $banner = BannerKelas::with(['items'])->find($id);

        if (!$banner) {
            return redirect()->back()->withErrors([
                'message' => 'Banner tidak tersedia, mungkin terhapus'
            ]);
        }

        if ($banner->items && count($banner->items) > 0) {
            BannerKelasKursus::where('id_banner_kelas', $banner->id)->delete();
        }

        $this->logAdmin("Menghapus banner kelas $banner->judul", $banner);

        $banner->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus banner kelas');
    }
}
