<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MetodePembayaran;
use App\Models\Bank;
use Illuminate\Support\Facades\Validator;

class MetodePembayaranController extends Controller
{
    //
    public function index_page()
    {
        $payments = MetodePembayaran::with(['bank'])
            ->whereIn('status', ['Aktif', 'Nonaktif'])
            ->paginate(20);
        return view('admin.pages.metodepembayaran.index', [
            'payments' => $payments
        ]);
    }
    public function add_page()
    {
        $banks = Bank::whereIn('status', ['Aktif', 'Nonaktif'])
            ->orderBy('nama', 'asc')
            ->get();
        return view('admin.pages.metodepembayaran.form', [
            "payment" => NULL,
            "banks" => $banks
        ]);
    }
    public function edit_page($id)
    {
        $payment = MetodePembayaran::with(['bank'])
            ->find($id);


        if (!$payment) {
            return abort(404);
        }

        $banks = Bank::whereIn('status', ['Aktif', 'Nonaktif'])
            ->orderBy('nama', 'asc')
            ->get();

        return view('admin.pages.metodepembayaran.form', [
            "payment" => $payment,
            "banks" => $banks
        ]);
    }
    public function detail_page($id)
    {
        $payment = MetodePembayaran::with(['bank'])
            ->find($id);


        if (!$payment) {
            return abort(404);
        }

        return view('admin.pages.metodepembayaran.detail', [
            "payment" => $payment
        ]);
    }
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'rekening' => 'required',
            'pemilik' => 'required',
            'tipe' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $bank = Bank::where('id', $request->bank)
            ->whereIn('status', ['Aktif', 'Nonaktif'])
            ->first();

        if (!$bank) {
            return redirect()->back()->withErrors([
                "message" => "Bank yang dipilih tidak ditemukan!"
            ]);
        }

        $payment = new MetodePembayaran;
        $payment->id_bank = $bank->id;
        $payment->tipe = $request->tipe;
        $payment->rekening = $request->rekening;
        $payment->pemilik = $request->pemilik;
        $payment->status = $request->status;
        if ($request->deskripsi) $payment->deskripsi = $request->deskripsi;
        $payment->save();

        $this->logAdmin("Menambah metode pembayaran $bank->nama", json_encode($payment));
        return redirect("/admin/metode-pembayaran")->with("success", "Berhasil menambah metode pembayaran");
    }

    public function edit(Request $request, $id)
    {
        $payment = MetodePembayaran::find($id);

        if (!$payment) {
            return redirect()->back()->withErrors([
                "message" => "Metode pembayaran tidak tersedia"
            ]);
        }

        $validator = Validator::make($request->all(), [
            'bank' => 'required',
            'rekening' => 'required',
            'pemilik' => 'required',
            'tipe' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $bank = Bank::where('id', $request->bank)
            ->whereIn('status', ['Aktif', 'Nonaktif'])
            ->first();

        if (!$bank) {
            return redirect()->back()->withErrors([
                "message" => "Bank yang dipilih tidak ditemukan!"
            ]);
        }

        $payment->id_bank = $bank->id;
        $payment->tipe = $request->tipe;
        $payment->rekening = $request->rekening;
        $payment->pemilik = $request->pemilik;
        $payment->status = $request->status;
        if ($request->deskripsi) $payment->deskripsi = $request->deskripsi;
        $payment->save();

        $this->logAdmin("Mengedit metode pembayaran $bank->nama", json_encode($payment));

        return redirect("/admin/metode-pembayaran")->with("success", "Berhasil mengedit metode pembayaran");
    }
    public function delete($id)
    {
        $payment = MetodePembayaran::with(['bank'])->find($id);

        if (!$payment) {
            return redirect()->back()->withErrors([
                "message" => "Metode pembayaran tidak tersedia"
            ]);
        }

        $namaBank = "";

        if ($payment->bank) {
            $namaBank = $payment->bank->nama;
        }

        $this->logAdmin("Menghapus metode pembayaran $namaBank", json_encode($payment));
        $payment->delete();
        return redirect("/admin/metode-pembayaran")->with("success", "Berhasil menghapus metode pembayaran");
    }
}
