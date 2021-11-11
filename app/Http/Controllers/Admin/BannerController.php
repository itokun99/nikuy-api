<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Slider;
use App\Models\Pilar;
use App\Models\Kelas;
use App\Models\PaketMember;
use App\Models\BannerKelas;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_page()
    {
        $slider = Slider::whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->orderBy('order', 'asc')
            ->get();

        $kelas = Kelas::where('kondisi', 'POSTING')->orderBy('order_id', 'asc')->get();


        $bannerKelas = BannerKelas::with(['kelas'])->orderBy('order', 'asc')->get();



        return view('admin.pages.setting.slider.index')
            ->with([
                "slider" => $slider,
                "kelas" => $kelas,
                "bannerKelas" => $bannerKelas
            ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'alt' => 'required',
            'kondisi' => 'required',
            'order' => 'required',
            'foto_slider' => 'required|max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $existing_order = Slider::where('order', $request->order)
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->first();

        if ($existing_order) {
            return redirect()->back()->withErrors([
                "message" => "Order already exists"
            ]);
        }

        $photo = NULL;
        $file = request()->file('foto_slider');
        if ($file) {
            $photo = $this->uploadFile($file, "assets/foto/slider");
        }

        $slider = new slider;
        $slider->alt = $request->alt;
        $slider->foto_slider = $photo;
        $slider->kondisi = $request->kondisi;
        $slider->order = $request->order;
        $slider->link = $request->link;
        $slider->save();

        $this->logAdmin("Menambahkan Banner $slider->foto_slider", json_encode($slider));

        return redirect()->back()->with('success', 'Berhasil membuat banner');
    }

    public function edit(Request $request, $id)
    {

        $slider = Slider::find($id);

        if (!$slider) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'alt' => 'required',
            'order' => 'required',
            'kondisi' => 'required',
            'foto_slider' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $existing_order = Slider::where('order', $request->order)
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->first();

        if ($existing_order && $existing_order->order != $slider->order) {
            $existing_order->order = $slider->order;
            $slider->order = $request->order;
        } else {
            $slider->order = $request->order;
        }


        $photo = NULL;
        $prevFile = NULL;
        $file = request()->file('foto_slider');


        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/slider');
            $prevFile = $slider->foto_slider;
            $slider->foto_slider = $photo;
        }

        $slider->alt = $request->alt;
        $slider->kondisi = $request->kondisi;
        $slider->link = $request->link;
        $slider->save();
        if ($existing_order) {
            $existing_order->save();
        }

        if ($photo && $prevFile) {
            $this->deleteFile($prevFile, 'assets/foto/slider');
        }

        $this->logAdmin("Mengedit Banner $slider->foto_slider", json_encode($slider));

        return redirect()->back()->with('success', 'Berhasil mengedit slider');
    }

    public function delete($id)
    {
        $slider = Slider::find($id);

        if (!$slider) {
            return abort(404);
        }

        $this->logAdmin("Menghapus Banner $slider->foto_slider", json_encode($slider));
        $slider->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus slider');
    }
}
