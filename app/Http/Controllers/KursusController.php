<?php

namespace App\Http\Controllers;

use App\Models\Kursus;
use App\Models\Pilar;
use App\Models\Kelas;
use App\Models\PaketMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KursusController extends Controller
{
    //course user gem
    public function gemtwo()

    {
        $gemms = kursus::all();
        // dd($gemms);
        return view('gemtwo')->with(["gemtwo" => $gemms]);
    }
}
