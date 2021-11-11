<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $table = "user";
    protected $primaryKey = 'id_user';

    protected $fillable = [
        "id_user",
        "nama_user",
        "alamat",
        "provinsi",
        "tgl_lahir",
        "jenis_kelamin",
        "no_hp",
        "email",
        "password",
        "foto",
        "hak_akses",
        "status",
        "setuju",
        "id_paket",
        "title",
        "summary"
    ];

    public function paket()
    {
        return $this->hasOne("App\Models\PaketMember", "id_paket", "id_paket");
    }

    public function paket_membership()
    {
        return $this->hasOne("App\Models\UserPaket", "id_user", "id_user");
    }


    public function province()
    {
        return $this->hasOne("App\Models\Provinsi", 'id_provinsi', 'provinsi');
    }

    public function bisnis()
    {
        return $this->hasMany("App\Models\UserPreneur", "id_user", "id_user");
    }

    public function event()
    {
        return $this->hasMany('App\Model\EventDaftar', 'id_user', 'id_user')->withTrashed();
    }

    public function akses()
    {
        return $this->hasOne("App\Models\Akses", "id_user", "id_user");
    }

    public function course_progress()
    {
        return $this->hasOne("App\Models\UserCourseProgress", "id_user", "id_user");
    }
}
