<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PaketMember extends Model
{

    use SoftDeletes;

    protected $table = "paket_member";
    protected $primaryKey = 'id_paket';

    public function paket_kelas()
    {
        return $this->hasMany('App\Models\PaketKelas', 'id_paket', 'id_paket');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'id_paket', 'id_paket');
    }

    public function members()
    {
        return $this->hasMany("App\Models\UserPaket", "id_paket", "id_paket");
    }
}
