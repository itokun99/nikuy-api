<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kursus;
use App\Models\Pilar;
use App\Models\PaketKelas;
use App\Models\PaketMember;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
{
    //CourseKelas

    public function course_kelas()
    {
        $coursekel = [];
        $coursekel_auth = [];
        $paket_kelas = PaketKelas::where("id_paket", 7)->orderBy('id_kelas', 'asc')->get();
        $paket_kelas_auth = PaketKelas::where("id_paket", \Auth::user()->id_paket)->orderBy('id_kelas', 'asc')->get();
        $paket_member = PaketMember::all();

        foreach ($paket_kelas_auth as $key => $kelas) {
            $find = Kelas::find($kelas->id_kelas);
            $paket_member = PaketMember::find($kelas->id_paket)->nama_paket;
            $coursekel_auth[$paket_member][$key] = $find;
            $coursekel_auth[$paket_member] = collect($coursekel_auth[$paket_member])->sortByDesc("order_id");
        }

        return view('course')->with(["Coursekelas" => $coursekel]);
    }

    public function course_separator($id_kelas)
    {
        $backup = [];
        $previous = null;
        $next = null;
        $kelas = Kelas::find($id_kelas);
        $content = $kelas;
        // $kursus = Kursus::where("id_kelas", $id_kelas)->orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get()->groupBy("id_pilar");
        $kursus = Kursus::orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get()->groupBy("id_pilar");
        $pilar = Pilar::orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get();

        foreach ($pilar as $key => $pilars) {
            foreach ($kursus as $keys => $kursuss) {
                if ($pilars->id_pilar == $keys) $backup[Pilar::find($keys)->nama_pilar] = $kursus[$keys];
            }
        }

        foreach ($backup as $key => $backups) {

            if (isset($backups) && isset($backups[0]) && isset($backups[1]) && $backups[0]->id_kelas == $id_kelas) {
                $next = $backups[1]->id_kursus;
                break;
            }
        }

        return view('gem')->with(["kelas" => $kelas, "kursus" => $backup, 'content' => $content, 'next' => $next, 'previous' => $previous]);
    }

    public function kursus_separator($id_kelas, $id_kursus)
    {
        $backup = [];
        $previous = null;
        $next = null;
        $kelas = Kelas::find($id_kelas);
        $content = Kursus::find($id_kursus);
        // $kursus = Kursus::where("id_kelas", $id_kelas)->orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get()->groupBy("id_pilar");
        $kursus = Kursus::orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get()->groupBy("id_pilar");
        $pilar = Pilar::orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get();

        foreach ($pilar as $key => $pilars) {
            foreach ($kursus as $keys => $kursuss) {
                // if($pilars->id_pilar == $keys) $backup[Pilar::find($keys)->nama_pilar] = $kursus[$keys];
                $backup[Pilar::find($keys)->nama_pilar] = $kursus[$keys];
            }
        }

        foreach ($backup as $key => $backups) {
            if ($backups[0]->id_kelas == $id_kelas) {
                foreach ($backups as $back_key => $backupss) {
                    if ($backupss->id_kursus == $id_kursus) {
                        if ($back_key == 0) {
                            $next = count($backups) == 1 ? null : $backups[1]->id_kursus;
                            break;
                        } else if ($back_key != count($backups) - 1) {
                            $next = $backups[$back_key + 1]->id_kursus;
                            $previous = $backups[$back_key - 1]->id_kursus;
                            break;
                        } else {
                            $previous = $backups[count($backups) - 2]->id_kursus;
                            break;
                        }
                    }
                }
            }
        }

        return view('gem')->with(["kelas" => $kelas, "kursus" => $backup, 'content' => $content, 'next' => $next, 'previous' => $previous]);
    }

    public function rating_saparator($id_kelas)
    {
        $backup = [];
        $kelas = Kelas::find($id_kelas);
        $content = $kelas;
        $kursus = Kursus::where("id_kelas", $id_kelas)->orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get()->groupBy("id_pilar");
        $pilar = Pilar::orderBy("order_id", "DESC")->orderBy("updated_at", "DESC")->get();
        $rating = Rating::where("id_user", \Auth::user()->id_user)->get();
        $rating = count($rating) > 0 ? $rating[0] : null;

        foreach ($pilar as $key => $pilars) {
            foreach ($kursus as $keys => $kursuss) {
                if ($pilars->id_pilar == $keys) $backup[Pilar::find($keys)->nama_pilar] = $kursus[$keys];
            }
        }

        return view('ratting')->with(["kelas" => $kelas, "kursus" => $backup, 'content' => $content, "rating" => $rating]);
    }

    public function rating_store($id_kelas)
    {
        $rating = new Rating;
        $update = Rating::where("id_user", \Auth::user()->id_user)->get();

        if (count($update) > 0)
            $rating = Rating::find($update[0]->id_rating);

        $rating->id_kelas = $id_kelas;
        $rating->level_rating = request("star");
        $rating->komentar = request("komentar");
        $rating->tgl_komen = \Carbon\Carbon::now()->format("Y-m-d");
        $rating->id_user = \Auth::user()->id_user;
        $rating->ket_rating = "Sudah dibaca";
        $rating->save();

        return redirect("/rating/$id_kelas");
    }
}
