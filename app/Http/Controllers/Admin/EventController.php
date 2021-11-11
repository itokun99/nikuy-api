<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index_page()
    {
        $eventss = Event::whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->orderBy('order_id', 'asc')
            ->paginate(10);
        return view('admin.pages.event.index')->with(["events" => $eventss]);
    }

    public function add_page()
    {
        return view('admin.pages.event.form')->with(["event" => null]);
    }

    public function edit_page($id)
    {
        $event = Event::with(['penulis'])->find($id);

        return view('admin.pages.event.form')->with(["event" => $event]);
    }

    public function detail_page($id)
    {
        $event = Event::with(['penulis'])->find($id);

        if (!$event) {
            return abort(404);
        }

        return view('admin.pages.event.detail', ['event' => $event]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'venue' => 'required',
            'nama_event' => 'required|min:3',
            'deskripsi' => 'required',
            'waktu' => 'required|date',
            'foto_event' => 'required|max:5120',
            'lokasi' => 'required',
            'harga_event' => 'required',
            'kuota' => 'required',
            'order_id' => 'required',
            'kondisi' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->order_id <= 0) {
            return redirect()->back()->withErrors([
                'message' => "Urutan harus bernilai positif, dimulai dari Urutan 1 dan seterusnya"
            ]);
        }

        $existing = Event::where('order_id', $request->order_id)->first();

        if ($existing) {
            return redirect()->back()->withErrors([
                'message' => "Urutan sudah digunakan untuk event lain"
            ]);
        }

        $photo = NULL;
        $file = request()->file('foto_event');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/event');
        }

        $event = new Event;
        $event->nama_event = $request->nama_event;
        $event->deskripsi = $request->deskripsi;
        $event->venue = $request->venue;
        $event->waktu = $request->waktu;
        $event->foto_event = $photo;
        $event->lokasi = $request->lokasi;
        $event->harga_event = $request->harga_event;
        $event->kuota = $request->kuota;
        $event->keterangan = $request->keterangan;
        $event->order_id = $request->order_id;
        $event->id_user = $request->id_user;
        $event->kondisi = $request->kondisi;
        $event->harga_diskon = $request->harga_diskon;
        $event->save();

        $this->logAdmin("Membuat event $event->nama_event", json_encode($event));
        return redirect("/admin/event")->with('success', 'Berhasil membuat event');
    }


    public function edit(Request $request, $id)
    {
        $event = Event::find($id);

        if (!$event) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'venue' => 'required',
            'nama_event' => 'required|min:3',
            'deskripsi' => 'required',
            'waktu' => 'required|date',
            'foto_event' => 'max:5120',
            'lokasi' => 'required',
            'harga_event' => 'required',
            'kuota' => 'required',
            'order_id' => 'required',
            'kondisi' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->order_id <= 0) {
            return redirect()->back()->withErrors([
                'message' => "Urutan harus bernilai positif, dimulai dari Urutan 1 dan seterusnya"
            ]);
        }

        $existing = Event::where('order_id', $request->order_id)->first();

        if ($existing && $existing->order_id != $event->order_id) {
            $existing->order_id = $event->order_id;
            $event->order_id = $request->order_id;
        } else {
            $event->order_id = $request->order_id;
        }

        $photo = NULL;
        $prevFile = NULL;
        $file = request()->file('foto_event');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/event');
            $prevFile = $event->foto_event;
            $event->foto_event = $photo;
        }

        $event->nama_event = $request->nama_event;
        $event->deskripsi = $request->deskripsi;
        $event->venue = $request->venue;
        $event->waktu = $request->waktu;
        $event->lokasi = $request->lokasi;
        $event->harga_event = $request->harga_event;
        $event->kuota = $request->kuota;
        $event->keterangan = $request->simpan;
        $event->order_id = $request->order_id;
        $event->id_user = $request->id_user;
        $event->kondisi = $request->kondisi;
        $event->harga_diskon = $request->harga_diskon;
        $event->save();

        if ($photo && $prevFile) {
            $this->deleteFile($prevFile, 'assets/foto/event');
        }

        $this->logAdmin("Mengedit event $event->nama_event", json_encode($event));
        return redirect("/admin/event")->with('success', 'Berhasil mengedit event');
    }

    public function delete($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return abort(404);
        }

        $this->logAdmin("Menghapus event $event->nama_event", json_encode($event));
        $event->delete();
        return redirect("/admin/event")->with('success', 'Berhasil menghapus event');
    }
}
