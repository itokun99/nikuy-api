<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class BankController extends Controller
{
    //
    public function index_page()
    {
        $banks = Bank::whereIn('status', ['Aktif', 'Nonaktif'])
            ->orderBy('nama', 'asc')
            ->paginate(20);

        return view('admin.pages.bank.index', [
            "banks" => $banks,
        ]);
    }

    public function add_page()
    {
        return view('admin.pages.bank.form', [
            "bank" => NULL,
        ]);
    }

    public function edit_page($id)
    {
        $bank = Bank::find($id);

        if (!$bank) {
            return abort(404);
        }

        return view('admin.pages.bank.form', [
            'bank' => $bank
        ]);
    }

    public function detail_page($id)
    {
        $bank = Bank::find($id);

        if (!$bank) {
            return abort(404);
        }

        return view('admin.pages.bank.detail', [
            'bank' => $bank
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'logo' => 'max:5120',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $bank = new Bank;
        $bank->nama = $request->nama;
        $bank->status = $request->status;
        if ($request->kode) $bank->kode = $request->kode;
        if ($request->intruksi) $bank->intruksi = $request->intruksi;

        $file = request()->file('logo');
        if ($file) {
            $bank->logo = $this->uploadFile($file, Helper::getAssetPath('bank'));
        }
        $bank->save();

        $this->logAdmin("Menambahkan bank $bank->nama", json_encode($bank));
        return redirect('/admin/bank')->with('success', 'Berhasil menambahkan bank ke daftar');
    }

    public function edit(Request $request, $id)
    {

        $bank = Bank::find($id);

        if (!$bank) {
            return redirect()->back()->withErrors([
                "message" => "Bank tidak ditemukan!"
            ]);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'logo' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $bank->nama = $request->nama;
        if ($request->status) $bank->status = $request->status;
        if ($request->kode) $bank->kode = $request->kode;
        if ($request->intruksi) $bank->intruksi = $request->intruksi;
        $file = request()->file('logo');

        if ($file) {
            $prevFile = $bank->logo;
            $bank->logo = $this->uploadFile($file, Helper::getAssetPath('bank'));
            $this->deleteFile($prevFile, Helper::getAssetPath('bank'));
        }

        $this->logAdmin("Mengedit bank $bank->nama", json_encode($bank));
        $bank->save();
        return redirect()->back()->with('success', "Berhasil mengedit bank $bank->nama");
    }

    public function delete($id)
    {
        $bank = Bank::find($id);

        if (!$bank) {
            return redirect()->back()->withErrors([
                "message" => "Bank tidak ditemukan!"
            ]);
        }

        if ($bank->logo) {
            $this->deleteFile($bank->logo, Helper::getAssetPath('bank'));
        }

        $this->logAdmin("Menghapus bank $bank->nama", json_encode($bank));
        $bank->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus bank');
    }
}
