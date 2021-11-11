<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketMember;
use App\Models\User;
use App\Models\MasaBerlakuPaket;
use Illuminate\Support\Facades\Validator;


class PaketMemberController extends Controller
{
    //
    public function index_page()
    {
        $paket = PaketMember::with([
            'paket_kelas.kelas', 'members'
        ])
            ->whereIn('kondisi', ['POSTING', 'DRAFT'])
            ->orderBy('order', 'ASC')
            ->paginate(10);

        return view('admin.pages.paket.index')->with(["paketmember" => $paket]);
    }



    public function add_page()
    {
        $form = new \stdClass();
        $form->id_paket = '';
        $form->nama_paket = '';
        $form->harga_member = '';
        $form->jumlah_kelas = '';
        $form->deskripsi_paket = '';
        $form->masa_berlaku = '';
        $form->foto_paket = '';
        $form->slug = '';
        $form->default = '';
        $form->order = '';

        $masa_berlaku = MasaBerlakuPaket::where('status', 'Aktif')->get();

        return view('admin.pages.paket.form')->with([
            "paket" => $form,
            'masa_berlaku' => $masa_berlaku
        ]);
    }

    public function edit_page(PaketMember $paket_member, $id)
    {
        $paket = $paket_member::find($id);

        if (!$paket) {
            return abort(404);
        }

        $masa_berlaku = MasaBerlakuPaket::where('status', 'Aktif')->get();

        return view('admin.pages.paket.form')
            ->with([
                'paket' => $paket,
                'masa_berlaku' => $masa_berlaku
            ]);
    }

    public function detail_page($id = NULL)
    {
        $paket = PaketMember::find($id);

        if (!$paket) {
            return abort(404);
        }

        $user = User::whereHas(
            'paket_membership',
            function ($query) use ($id) {
                $query->where('id_paket', $id);
            }
        )->where('hak_akses', 'Member')
            ->whereIn('status', ['Aktif', 'Deactive']);

        $memberCount = $user->count();
        $members = $user->paginate(10);

        return view('admin.pages.paket.detail', [
            'paket' => $paket,
            'memberCount' => $memberCount,
            'members' => $members,
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_paket' => 'required',
            'harga_member' => 'required',
            'deskripsi_paket' => 'required',
            'foto_paket' => 'required|max:5120',
            'masa_berlaku' => 'required',
            'order' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }


        $photo = NULL;
        $file = request()->file('foto_paket');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/paket');
        }

        $paket_member = new PaketMember;

        $existing_default = PaketMember::where('default', 1)->first();

        if ($existing_default) {
            $existing_default->default = 0;
            $paket_member->default = $request->default;
        } else {
            $paket_member->default = $request->default;
        }

        $existing_order = PaketMember::where('order', $request->order)->first();

        if ($existing_order) {
            return redirect()->back()->withErrors([
                "message" => "Urutan $request->order sudah ada pada paket lain!, masukan urutan berbeda"
            ]);
        }

        $paket_member->nama_paket = $request->nama_paket;
        $paket_member->harga_member = $request->harga_member;
        $paket_member->deskripsi_paket = $request->deskripsi_paket;
        $paket_member->jumlah_kelas = 0;
        $paket_member->foto_paket = $photo;
        $paket_member->masa_berlaku = $request->masa_berlaku;
        $paket_member->slug = $request->slug;
        $paket_member->kondisi = $request->simpan;
        $paket_member->default = $request->default;
        $paket_member->save();
        $existing_default->save();

        $this->logAdmin("Menambahkan Paket Membership $paket_member->nama_paket", json_encode($paket_member));
        return redirect("/admin/paket")->with('success', 'Berhasil membuat paket');
    }

    public function edit(Request $request, PaketMember $paket_member, $id)
    {
        $paket_member = PaketMember::find($id);

        if (!$paket_member) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'nama_paket' => 'required',
            'harga_member' => 'required',
            'deskripsi_paket' => 'required',
            'foto_paket' => 'max:5120',
            'masa_berlaku' => 'required',
            'slug' => 'required',
        ]);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $photo = NULL;
        $prevFile = NULL;
        $file = request()->file('foto_paket');
        if ($file) {
            $photo = $this->uploadFile($file, 'assets/foto/paket');
            $prevFile = $paket_member->foto_paket;
            $paket_member->foto_paket = $photo;
        }

        $existing_default = PaketMember::where('default', 1)->first();

        if ($existing_default) {
            $existing_default->default = 0;
            $paket_member->default = $request->default;
        } else {
            $paket_member->default = $request->default;
        }


        if ($request->order) {
            $existing_order = PaketMember::where('order', $request->order)->first();

            if ($existing_order && $existing_order->order != $paket_member->order) {
                $existing_order->order = $paket_member->order;
                $paket_member->order = $request->order;
                $existing_order->save();
            } else {
                $paket_member->order = $request->order;
            }
        }

        $paket_member->nama_paket = $request->nama_paket;
        $paket_member->harga_member = $request->harga_member;
        $paket_member->deskripsi_paket = $request->deskripsi_paket;
        $paket_member->jumlah_kelas = 0;
        $paket_member->masa_berlaku = $request->masa_berlaku;
        $paket_member->slug = $request->slug;
        $paket_member->kondisi = $request->simpan;
        $paket_member->save();

        if ($photo && $prevFile) {
            $this->deleteFile($prevFile, 'assets/foto/paket');
        }


        $this->logAdmin("Mengedit Paket Membership $paket_member->nama_paket", json_encode($paket_member));

        return redirect("/admin/paket")->with('success', 'Berhasil mengedit paket');
    }

    public function delete($id)
    {
        $paket = PaketMember::with(['users', 'paket_kelas'])->find($id);

        if (!$paket) {
            return abort(404);
        }

        if ($paket->users && count($paket->users) > 0) {
            return back()->withErrors([
                "message" => "Gagal menghapus paket karena memiliki beberapa member, ubah terlebih dahulu jenis membership pada member yang terikat dengan paket ini"
            ]);
        }

        if ($paket->paket_kelas && count($paket->paket_kelas)) {
            return back()->withErrors([
                "message" => "Gagal menghapus paket karena memiliki beberapa kelas, hapus terlebih dahulu kelas yang terikat dengan paket ini"
            ]);
        }

        if ($paket->foto_paket) {
            $this->deleteFile($paket->foto_paket, 'assets/foto/paket');
        }

        $this->logAdmin("Menghapus Paket Membership $paket->nama_paket", json_encode($paket));

        $paket->delete();
        return redirect("/admin/paket")->with('success', 'Berhasil menghapus Paket Membership dari daftar');
    }
}
