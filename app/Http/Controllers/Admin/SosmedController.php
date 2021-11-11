<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sosmed;
use Illuminate\Support\Facades\Validator;

class SosmedController extends Controller
{
    //
    public function index_page()
    {
        $sosmed = Sosmed::all();

        return view('admin.pages.setting.sosialmedia.index', [
            'sosmed' => $sosmed
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_sosmed' => 'required',
            'link_sosmed' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $logo = NULL;
        $file = request()->file('logo');

        if ($file) {
            $logo = $this->uploadFile($file, 'assets/foto/sosmed');
        }

        $sosmed = Sosmed::create([
            'nama_sosmed' => $request->nama_sosmed,
            'akun' => $request->akun,
            'link_sosmed' => $request->link_sosmed,
            'logo_sosmed' => $logo
        ]);

        if (!$sosmed) {
            return redirect()->back()->withErrors([
                'message' => 'Gagal menyimpan data sosial media'
            ]);
        }


        $this->logAdmin("Menambahkan sosial media $sosmed->nama_sosmed", $sosmed);

        return redirect()->back()->with('success', 'Berhasil menyimpan data sosial media');
    }

    public function edit(Request $request, $id)
    {
        $sosmed = Sosmed::find($id);

        if (!$sosmed) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_sosmed' => 'required',
            'link_sosmed' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $logo = NULL;
        $prevFile = NULL;
        $file = request()->file('logo');

        if ($file) {
            $prevFile = $sosmed->logo_sosmed;
            $logo = $this->uploadFile($file, 'assets/foto/sosmed');
            $sosmed->logo_sosmed = $logo;
        }

        $sosmed->nama_sosmed = $request->nama_sosmed;
        $sosmed->akun = $request->akun;
        $sosmed->link_sosmed = $request->link_sosmed;
        $sosmed->save();

        if ($logo && $prevFile) {
            $this->deleteFile($prevFile, 'assets/foto/sosmed');
        }

        $this->logAdmin("Mengedit sosial media $sosmed->nama_sosmed", $sosmed);

        return redirect()->back()->with('success', 'Berhasil menyimpan data sosial media');
    }

    public function delete($id)
    {
        $sosmed = Sosmed::find($id);

        if (!$sosmed) {
            return abort(404);
        }

        $this->logAdmin("Menghapus sosial media $sosmed->nama_sosmed", $sosmed);

        $sosmed->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus sosial media');
    }
}
