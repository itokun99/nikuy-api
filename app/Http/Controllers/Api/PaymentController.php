<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MetodePembayaran;
use App\Http\Resources\PaymentCollection;

class PaymentController extends Controller
{
    //

    public function get()
    {
        $payments = MetodePembayaran::with(['bank'])
            ->whereIn('status', ['Aktif'])
            ->orderBy('id', 'asc')
            ->get();

        return new PaymentCollection($payments);
    }
}
