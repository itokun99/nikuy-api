<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaketMember;
use App\Models\User;
use App\Models\UserPreneur;
use App\Models\Provinsi;
use App\Models\UserPaket;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Helper\Helper;
use Carbon\Carbon;




class MemberController extends Controller
{
    //
    public function index_page(Request $request)
    {

        $modelPaketMember = new PaketMember();
        $selectedType = NULL;
        $paketMember = $modelPaketMember->where(['kondisi' => 'POSTING'])->get();

        foreach ($paketMember as $paket) {
            $member = User::where(['status' => 'Aktif', 'hak_akses' => 'Member', 'id_paket' => $paket->id_paket])->count();
            $paket->memberCount = $member;
        }

        if ($request->has('type')) {
            $selectedType = $modelPaketMember->where(['kondisi' => 'POSTING', 'slug' => $request->get('type')])->first();
        }

        $memberQuery = User::with(['bisnis', 'paket', 'paket_membership.paket'])->where(['hak_akses' => 'Member'])->whereIn('status', ['Aktif', 'Deactive']);
        $memberCount = $memberQuery->count();

        if ($selectedType) {
            $memberQuery = $memberQuery->where('id_paket', $selectedType->id_paket);
        }

        $memberList = $memberQuery->orderBy('nama_user', 'asc')->paginate(10)->withQueryString();

        // dd($memberList);

        return view('admin.pages.member.index')->with([
            "member" => $memberList,
            "paketMember" => $paketMember,
            "memberCount" => $memberCount,
        ]);
    }

    public function add_page()
    {
        $provinsi = Provinsi::all();
        $paket = PaketMember::whereIn('kondisi', ['POSTING'])->get();
        return view('admin.pages.member.form')
            ->with([
                'user' => null,
                "provinsi" => $provinsi,
                'paket' => $paket
            ]);
    }

    public function edit_page($id)
    {
        $user = User::with(['paket_membership.paket'])->find($id);
        if (!$user) {
            return abort(404);
        }

        $paket = PaketMember::whereIn('kondisi', ['POSTING'])->get();
        $provinsi = Provinsi::all();
        return view('admin.pages.member.form')
            ->with([
                'user' => $user,
                "provinsi" => $provinsi,
                "paket" => $paket
            ]);
    }

    public function detail_page($id = NULL)
    {
        $user = User::with(['province', 'bisnis.province', 'paket', 'paket_membership.paket'])->find($id);
        if (!$user) {
            return abort(404);
        }

        return view('admin.pages.member.detail', [
            "user" => $user
        ]);
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:user',
            'nama' => 'required',
            'password' => 'required|min:6|confirmed',
            'paket' => 'required',
            'status' => 'required',
            'foto' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $paket = PaketMember::where('id_paket', $request->paket)
            ->whereIn('kondisi', ['POSTING'])
            ->first();

        if (!$paket) {
            return redirect()->back()->withErrors([
                'message' => 'Jenis Membership yang dipilih tidak ditemukan, silahkan tambah paket terlebih dahulu atau coba pilih yang lain'
            ]);
        }

        $photo = NULL;
        $file = request()->file('foto');
        $id = $this->generateId();

        if ($file) {
            $photo = $this->uploadFile($file, 'uploads/photo');
        }

        $user = new User;
        $user->id_user = $id;
        $user->nama_user = $request->nama;
        $user->alamat = $request->alamat;
        $user->provinsi = $request->provinsi;
        $user->tgl_lahir = $request->tglahir;
        $user->jenis_kelamin = $request->jekel;
        $user->no_hp = $request->nohp;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->foto = $photo;
        $user->hak_akses = "Member";
        $user->status = $request->status;
        $user->setuju = "ya";
        $user->id_paket = $paket->id_paket;
        $user->title = $request->title;
        $user->summary = $request->summary;
        $user->save();

        $sub = Helper::getSubscribeAndExpired($paket->masa_berlaku);

        UserPaket::create([
            'id_user' => $id,
            'id_paket' => $paket->id_paket,
            'subscribe_at' => $sub->subscribe_at,
            'expired_at' => $sub->expired_at
        ]);

        $this->logAdmin("Memambahkan member $user->email", json_encode($user));

        return redirect("/admin/member")->with('success', 'Berhasil menambahkan member baru');
    }

    public function edit(Request $request, $id)
    {

        $user = User::with(['paket', 'province', 'paket_membership.paket'])
            ->where('id_user', $id)
            ->whereIn('status', ['Aktif', 'Deactive'])
            ->first();

        if (!$user) {
            return abort(404);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'nama' => 'required',
            'status' => 'required',
            'paket' => 'required',
            'foto' => 'max:5120',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($user->email != $request->email) {
            $existing = User::where('email', $request->email)->whereIn('status', ['Aktif', 'Deactive'])->first();
            if ($existing) {
                return redirect()->back()->withErrors([
                    "message" => "Email $request->email sudah digunakan, gunakan email yang lain"
                ]);
            }

            $user->email = $request->email;
        }

        // validasi perubahan kata sandi user
        if ($request->password) {
            $validator = Validator::make($request->all(), [
                'password' => 'required|min:6|confirmed',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }

            $user->password = Hash::make($request->password);
        }

        // validasi untuk ketersediaan paket yang dipilih
        if ($user->paket && $user->paket->id_paket != $request->paket) {
            $paket = PaketMember::where('id_paket', $request->paket)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            if (!$paket) {
                return redirect()->back()->withErrors([
                    'message' => 'Jenis Membership yang dipilih tidak ditemukan, coba pilih yang lain'
                ]);
            }
            $user->id_paket = $request->paket;
        }

        $photo = NULL;
        $prevFotoFile = NULL;
        $file = request()->file('foto');
        $id = $this->generateId();
        if ($file) {
            $photo = $this->uploadFile($file, 'uploads/photo');
            $prevFotoFile = $user->foto;
            $user->foto = $photo;
        }

        // validasi untuk perubahan status user
        if ($user->status != $request->status) {
            $user->status = $request->status;
        }

        $user->nama_user = $request->nama;
        $user->alamat = $request->alamat;
        $user->tgl_lahir = $request->tglahir;
        $user->jenis_kelamin = $request->jekel;
        $user->provinsi = $request->provinsi;
        $user->no_hp = $request->nohp;
        $user->title = $request->title;
        $user->summary = $request->summary;
        $user->save();


        if ($request->paket) {
            $paket = PaketMember::where('id_paket', $request->paket)
                ->whereIn('kondisi', ['POSTING'])
                ->first();

            if (!$paket) {
                return redirect()->back()->withErrors([
                    'message' => 'Jenis Membership yang dipilih tidak ditemukan, coba pilih yang lain'
                ]);
            }

            $user_paket = UserPaket::where("id_user", $user->id_user)->first();

            $sub = Helper::getSubscribeAndExpired($paket->masa_berlaku);

            if ($user_paket) {
                if ($user_paket->id_paket != $paket->id_paket) {
                    $user_paket->id_paket = $paket->id_paket;
                    $user_paket->subscribe_at = $sub->subscribe_at;
                    $user_paket->expired_at = $sub->expired_at;
                    $user_paket->save();
                }
            } else {
                UserPaket::create([
                    'id_user' => $user->id_user,
                    'id_paket' => $paket->id_paket,
                    'subscribe_at' => $sub->subscribe_at,
                    'expired_at' => $sub->expired_at
                ]);
            }
        }

        // validasi hapus foto
        if ($photo && $prevFotoFile) {
            $this->deleteFile($prevFotoFile, 'uploads/photo');
        }

        $this->logAdmin("Mengedit member $user->email", json_encode($user));

        return redirect("/admin/member")->with('success', 'Berhasil memperbarui data member');
    }

    public function delete($id)
    {
        $user = User::find($id);

        if (!$user) {
            return abort(404);
        }

        $user->paket_membership()->delete();
        if ($user->foto) {
            $this->deleteFile($user->foto, 'uploads/photo');
        }

        $this->logAdmin("Menghapus member $user->email", json_encode($user));

        $user->delete();

        return redirect('/admin/member')->with('success', "Berhasil menghapus member $user->nama_user");
    }

    public function export()
    {
        $member = User::where(['hak_akses' => 'Member'])->get()->downloadExcel(
            "members.xlsx",
            $writerType = null,
            $headings = true
        );
        return $member;
    }
}
