<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PaketMember;
use App\Models\Transaksi;
use App\Models\Event;
use App\Models\UserPaket;
use App\Helper\Helper;
use Illuminate\Support\Carbon;
use App\Http\Resources\TransactionCollection;
use App\Http\Resources\TransactionResource;

class TransactionController extends Controller
{
    //

    public function get(Request $request)
    {

        $user = $request->user;

        $transactions = Transaksi::with(['paket', 'event'])
            ->where("id_user", $user->id_user)
            ->whereIn('keterangan', ["Pending", "Menunggu", "Ok", "Ditolak"])
            ->orderBy('created_at', 'desc')
            ->get();

        return new TransactionCollection($transactions);
    }

    public function getById(Request $request, $id)
    {
        $user = $request->user;
        $timenow = Carbon::now();

        $tr = Transaksi::with(['paket', 'event'])
            ->where("id_user", $user->id_user)
            ->where("id_transaksi", $id)
            ->whereIn('keterangan', ["Pending", "Menunggu", "Ok", "Ditolak"]);
        $transaction = $tr->first();
        $expired = $tr->where("tgl_berakhir", "<=", $timenow)->first();

        if (!$transaction) {
            return $this->responseError("Transaction not found", 404);
        }

        if ($expired) {
            $transaction->delete();
            return $this->responseError("Transaction is expired", 400);
        }

        return $this->responseSuccess("Successfully", 200, new TransactionResource($transaction));
    }

    public function create(Request $request)
    {
        $user = $request->user;
        $event = NULL;
        $membership = NULL;
        $timenow = Carbon::now();
        $transaction_date = $timenow->format('Y-m-d H:i:s');
        $expired_date = $timenow->addDays(1)->format('Y-m-d H:i:s');

        if (!$request->name) {
            return $this->responseError("name is required");
        }

        if (!$request->event && !$request->membership) {
            return $this->responseError("No item purchased");
        }

        if ($request->membership) {
            $membership = PaketMember::where('id_paket', $request->membership)
                ->whereIn('kondisi', ['POSTING'])
                ->first();
            if (!$membership) {
                return $this->responseError("Membership not found", 404);
            }

            $user_paket = UserPaket::with(['paket'])
                ->where('id_user', $user->id_user)
                ->first();

            if ($user_paket) {
                if ($user_paket->id_paket == $membership->id_paket) {
                    return $this->responseError("You are already on this membership", 400);
                }

                if ($user_paket->paket && $user_paket->paket->order > $membership->order) {
                    return $this->responseError("You cannot back to previous membership until expiration of " . $user_paket->paket->nama_paket, 400);
                }
            }
        }

        if ($request->event) {
            $event = Event::where('id_event', $request->event)
                ->whereIn('kondisi', ['POSTING'])
                ->first();
            if (!$event) {
                return $this->responseError("Event not found", 404);
            }
        }


        $nominal = 0;
        if ($membership) $nominal = $nominal + $membership->harga_member;
        if ($event) $nominal = $nominal + $event->harga_event;

        $transaction = new Transaksi;
        $transaction->id_transaksi = $this->generateId();
        $transaction->nama_transaksi = $request->name;
        $transaction->biaya_transaksi = $nominal;
        $transaction->tgl_transaksi = $transaction_date;
        $transaction->tgl_berakhir = $expired_date;
        $transaction->id_user = $user->id_user;
        if ($membership) $transaction->id_paket = $membership->id_paket;
        if ($event) $transaction->id_event = $event->id_event;
        $transaction->keterangan = "Pending";
        $transaction->save();

        return $this->responseSuccess("Transaction created", 201, [
            "id" => $transaction->id_transaksi
        ]);
    }

    public function update(Request $request, $id)
    {
        $timenow = Carbon::now();

        $tr = Transaksi::where("id_transaksi", $id)->whereIn("keterangan", ["Pending"]);
        $transaction = $tr->first();
        $expired = $tr->where("tgl_berakhir", "<=", $timenow)->first();

        if (!$transaction) {
            return $this->responseError("Not Found", 404);
        }

        if ($expired) {
            $transaction->delete();
            return $this->responseError("Transaction is expired", 400);
        }

        $validator = Validator::make($request->all(), [
            "account" => "required",
            "owner" => "required",
            "bank" => "required",
            "file" => "required",
        ]);

        if ($validator->fails()) {
            return $this->responseError("Fail to update transaction", 400, $validator->errors());
        }

        $transaction->no_rek = $request->account;
        $transaction->nama_rekening = $request->owner;
        $transaction->bank_asal = $request->bank;

        $file = request()->file("file");
        if ($file) {
            $transaction->foto_struk = $this->uploadFile($file, Helper::getAssetPath('transaksi'));
        }
        $transaction->keterangan = "Menunggu";
        $transaction->save();

        return $this->responseSuccess("Transaction updated", 200);
    }
}
