<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\EventDaftar;
use App\Models\PaketMember;
use App\Models\Event;
use App\Models\UserPaket;
use Illuminate\Support\Facades\Validator;
use App\Helper\Helper;

class TransaksiController extends Controller
{
    //
    public function index_page(Request $request)
    {
        $pendingCount = Transaksi::where('keterangan', 'Menunggu')->count();
        $transaksi = new Transaksi;
        $transaksi = $transaksi->with(['user', 'paket', 'event']);

        if ($request->has('keterangan') && $request->get('keterangan') != '') {
            $transaksi = $transaksi->where('keterangan', $request->get('keterangan'));
        } else {
            $transaksi = $transaksi->whereIn('keterangan', [
                'Menunggu',
                'Ok',
                'Ditolak',
                'Expired'
            ]);
        }

        $transaksis = $transaksi->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();


        return view('admin.pages.transaksi.index')->with([
            "transaksi" => $transaksis,
            'pendingCount' => $pendingCount
        ]);
    }

    public function detail_page($id)
    {
        $transaksi = Transaksi::with(['user', 'event', 'paket'])->find($id);

        if (!$transaksi) {
            return abort(404);
        }

        return view('admin.pages.transaksi.detail', [
            'transaksi' => $transaksi
        ]);
    }

    public function confirmed($id)
    {
        $user = NULL;
        $transaksi = Transaksi::with(['user', 'paket', 'event'])
            ->where('id_transaksi', $id)
            ->whereIn('keterangan', ['Menunggu'])
            ->first();

        if (!$transaksi) {
            return redirect()->back()->withErrors([
                'message' => 'Transaksi tidak ditemukan, mungkin sudah diproses atau terhapus'
            ]);
        }

        if (!$transaksi->user) {
            return redirect()->back()->withErrors([
                'message' => 'Transaksi tidak valid karena member tidak ditemukan dalam database'
            ]);
        }

        if ($transaksi->user) {
            $user = User::where('id_user', $transaksi->user->id_user)
                ->whereIn('status', ['Aktif'])
                ->whereIn('hak_akses', ['Member'])
                ->first();

            if (!$user) {
                return redirect()->back()->withErrors([
                    'message' => 'Transaksi tidak valid karena status member tidak aktif'
                ]);
            }
        }


        if ($transaksi->paket) {
            $paket = PaketMember::where('id_paket', $transaksi->paket->id_paket)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            if (!$paket) {
                return redirect()->back()->withErrors([
                    'message' => 'Transaksi tidak valid karena Paket Membership tidak diposting'
                ]);
            }


            $user_paket = UserPaket::where('id_user', $transaksi->user->id_user)->first();
            $sub = Helper::getSubscribeAndExpired($paket->masa_berlaku);

            if ($user_paket) {
                if ($user_paket->id_paket == $transaksi->paket->id_paket) {
                    $p = $transaksi->paket->nama_paket;
                    return redirect()->back()->withErrors([
                        "message" => `Transaksi tidak valid karena member ini sudah memiliki membership $p`
                    ]);
                } else {
                    $user_paket->id_paket = $transaksi->paket->id_paket;
                    $user_paket->subscribe_at = $sub->subscribe_at;
                    $user_paket->expired_at = $sub->expired_at;
                    $user_paket->save();
                }
            } else {
                UserPaket::create([
                    'id_user' => $transaksi->user->id_user,
                    'id_paket' => $transaksi->paket->id_paket,
                    'subscribe_at' => $sub->subscribe_at,
                    'expired_at' => $sub->expired_at
                ]);
            }
        }

        if ($transaksi->event) {
            $event = Event::where('id_event', $transaksi->event->id_event)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            if (!$event) {
                return redirect()->back()->withErrors([
                    'message' => 'Transaksi tidak valid karena Event tidak diposting'
                ]);
            }

            $event_daftar = EventDaftar::where([
                'id_user' => $transaksi->user->id_user,
                'id_event' => $transaksi->event->id_event
            ])
                ->first();

            if ($event_daftar) {
                return redirect()->back()->withErrors([
                    "message" => `Transaksi tidak valid karena member ini sudah memiliki terdaftar pada event $event->nama_event`
                ]);
            } else {
                EventDaftar::create([
                    'id_user' => $transaksi->user->id_user,
                    'id_event' => $transaksi->event->id_event
                ]);
            }
        }

        $transaksi->keterangan = "Ok";
        $transaksi->tgl_berakhir = NULL;
        $transaksi->save();

        if ($transaksi->paket) {
            $p = $transaksi->paket->nama_event;
            $this->logAdmin("Menerima proses transaksi dengan id $transaksi->id_transaksi untuk pembelian paket membership $p");
        }

        if ($transaksi->event) {
            $e = $transaksi->event->nama_event;
            $this->logAdmin("Menerima proses transaksi dengan id $transaksi->id_transaksi untuk pendaftaran Event $e");
        }

        return redirect()->back()->with('success', "Transaksi dengan ID $transaksi->id_transaksi berhasil diterima");
    }

    public function rejected(Request $request, $id)
    {
        $transaksi = Transaksi::with(['user', 'paket', 'event'])
            ->where('id_transaksi', $id)
            ->whereIn('keterangan', ['Menunggu'])
            ->first();

        if (!$transaksi) {
            return redirect()->back()->withErrors([
                'message' => 'Transaksi tidak ditemukan, mungkin sudah diproses atau terhapus'
            ]);
        }

        $validator = Validator::make($request->all(), [
            'pesan' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $transaksi->keterangan = "Ditolak";
        $transaksi->pesan = $request->pesan;
        $transaksi->tgl_berakhir = NULL;
        $transaksi->save();

        $this->logAdmin("Menolak proses transaksi dengan id $transaksi->id_transaksi dengan alasan $transaksi->pesan");

        return redirect()->back()->with('success', "Transaksi dengan ID $transaksi->id_transaksi ditolak");
    }

    public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        if (!$transaksi) {
            return abort(404);
        }
        $this->logAdmin("Menghapus proses transaksi dengan id $transaksi->id_transaksi");
        $transaksi->delete();
        return redirect("/admin/transaksi")->with('success', 'Berhasil menghapus transaksi');
    }
}
