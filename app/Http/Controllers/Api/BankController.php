<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Http\Resources\BankCollection;

class BankController extends Controller
{
    //
    public function get()
    {
        $banks = Bank::whereIn('status', ['Aktif'])
            ->orderBy('nama', 'asc')
            ->get();

        return new BankCollection($banks);
    }
}
