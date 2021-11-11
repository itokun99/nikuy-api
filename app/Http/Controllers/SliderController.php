<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Pilar;
use App\Models\Kelas;
use App\Models\PaketMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slider()
    {
        $slider = Slider::all();
        return view('admin.pages.setting.slider.index')->with(["slider" => $slider]);
    }

    public function tambah_slider()
    {
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.pages.setting.slider.form')->with(["slider" => null, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    public function edit($id)
    {
        $slider = Slider::findorfail($id);
        $pilar = Pilar::all();
        $kelas = Kelas::where('kondisi', 'POSTING')->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();
        return view('admin.pages.setting.slider.form')->with(["slider" => $slider, 'kelas' => $kelas, 'pmember' => $pmember, 'pilar' => $pilar]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'alt' => 'required',
            'foto_slider' => 'required|max:5120',
            'link' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $photo = '';
        $file = request()->file('foto_slider');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/slider/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/slider/', $photo);
            }
        }

        $slider = new slider;
        $slider->alt = $request->alt;
        $slider->foto_slider = $photo;
        $slider->link = $request->link;
        $slider->save();

        return redirect("/admin/slider")->with('success', 'Berhasil membuat slider');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider, $id)
    {
        $timenow = \Carbon\Carbon::now();
        $validator = Validator::make($request->all(), [
            'alt' => 'required',
            'foto_slider' => 'max:5120',
            'link' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $photo = '';
        $file = request()->file('foto_slider');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/slider/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/slider/', $photo);
            }
        }

        $slider = Slider::findorfail($id);
        $slider->foto_slider = $photo ? $photo : $slider->foto_slider;
        $slider->alt = $request->alt;
        $slider->link = $request->link;
        $slider->save();

        return redirect("/admin/slider")->with('success', 'Berhasil mengedit slider');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider, $id)
    {
        $slider = Slider::find($id);

        if ($slider) {
            $slider->delete();
            return redirect("/admin/slider")->with('success', 'Berhasil menghapus slider');
        }

        return redirect("/admin/slider")->with('errors', 'Gagal menghapus slider');
    }
}
