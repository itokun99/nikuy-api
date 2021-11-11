<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Info;

class InfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banner()
    {
        $Info = Info::where('jenis_info', 'EliTES Membership')->get();
        // dd($event);
        // dd($Info);

        return view('admin.home_banner')->with(["informasi" => $Info]);
        //
    }

    public function event()
    {
        $event = Info::where('jenis_info','Event')->get();
        // dd($event);
        // dd($Info);

        return view('admin.informasi_event')->with(["event" => $event]);
        //
    }

    public function course()
    {
        $course = Info::where('jenis_info','Course')->get();
        //dd($course);
        // dd($Info);

        return view('admin.informasi_course')->with(["course" => $course]);
        //
    }

    public function term()
    {
        $term = Info::where('jenis_info','Term and Condition')->get();
       // dd($term);
        // dd($Info);

        return view('admin.informasi_term')->with(["term" => $term]);
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
