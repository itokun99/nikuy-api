<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Slider;
use App\Models\Provinsi;
use App\Models\Kursus;
use App\Models\PaketMember;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $bg = [];
        $slider = Slider::all();
        $provinsi = Provinsi::all();
        $kursus = Kursus::where("id_paket", 5)->orWhere("id_paket", 7)->get();
        $pmember = PaketMember::where('kondisi', 'POSTING')->get();

        foreach($pmember as $member){
            $bg[$member->id_paket] = $member->background;
        }

        foreach($kursus as $kursuss){
            $kursuss->background = $bg[$kursuss->id_paket];
        }

        $event = Event::where('waktu', '>=', \Carbon\Carbon::now())->limit(3)->get();
        return view('welcome')->with(["event" => $event, "slider" => $slider, "provinsi" => $provinsi, "kursus" => $kursus]);
    }
}
