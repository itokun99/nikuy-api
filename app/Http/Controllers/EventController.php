<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Transaksi;
use App\Models\EventDaftar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = Event::where('waktu', '>=', \Carbon\Carbon::now())->orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->limit(3)->get();
        $pagination = Event::where('waktu', '>=', \Carbon\Carbon::now())->orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->paginate(3);

        return view('event')->with(["event" => $event, "pagination" => $pagination]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $show = Event::find($id);
        //dd($show);
        return view('daftar')->with(["event" => $show]);
    }


    public function export_event($id = null)
    {

        $events = $id == null ? Event::all() : Event::where('id_event', $id)->get();
        foreach ($events as $event) {
            $daftar = EventDaftar::where('id_event', $event->id_event)->get()->pluck('id_user');
            if (count($daftar) > 0) {
                $event->member = $daftar;
            } else {
                $event->member = null;
            }
        }

        $events = $events->downloadExcel(
            "event.xlsx",
            $writerType = null,
            $headings = true
        );

        return $events;
    }

    public function export_oneevent($id)
    {
        dd('asd');
        // $events = Event::all();
        // foreach($events as $event){
        //     $daftar = EventDaftar::where('id_event', $event->id_event)->get()->pluck('id_user');
        //     if(count($daftar) > 0){
        //         $event->member = $daftar;
        //     }else{
        //         $event->member = null;
        //     }
        // }

        // $events = $events->downloadExcel(
        //     "event.xlsx",
        //     $writerType = null,
        //     $headings = false
        // );

        // return $events;
    }

    public function daftar_event($id_event)
    {
        $event = Event::find($id_event);

        return view('event_daftar')->with(["event" => $event]);
    }

    public function daftar($id_event)
    {
        $request = request();
        $timenow = \Carbon\Carbon::now();

        $photo = '';
        $file = request()->file('foto');
        if ($file) {
            $photo = $timenow->format('Ymdhis') . "." . $file->extension();
            if (env('APP_ENV') == 'production') {
                $file->move('/home/u1367281/public_html/assets/foto/struk/', $photo);
            } else {
                $file->move(base_path() . '/public/assets/foto/struk/', $photo);
            }
        }

        $transaksi = new Transaksi;
        $transaksi->nama_transaksi = $request->transaksi;
        $transaksi->no_rek = $request->norek;
        $transaksi->bank_asal = $request->bank;
        $transaksi->nama_rekening = $request->nama;
        $transaksi->tgl_transaksi = \Carbon\Carbon::now()->format("Y-m-d");
        $transaksi->id_event = $id_event;
        $transaksi->nama_transaksi = $request->transaksi;
        $transaksi->id_user = \Auth::user()->id_user;
        $transaksi->biaya_transaksi = $request->harga;
        $transaksi->keterangan = "Menunggu";
        $transaksi->baca_admin = "Sudah dibaca";
        $transaksi->baca_member = "Sudah dibaca";
        $transaksi->foto_struk = $photo;
        $transaksi->tgl_berakhir = \Carbon\Carbon::now()->addDays(2)->format("Y-m-d");
        $transaksi->save();

        $event = new EventDaftar;
        $event->id_event = $id_event;
        $event->id_user = \Auth::user()->id_user;
        $event->save();

        return redirect("/transaksi");
    }
}
