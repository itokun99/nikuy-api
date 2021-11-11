<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Provinsi;
use App\Models\Kursus;
use App\Models\PaketMember;
use App\Models\Event;

class HomepageController extends Controller
{
    //
    public function index_page()
    {
        return view('web.pages.homepage.index');
    }
}
