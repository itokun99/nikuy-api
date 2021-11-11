<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class PaketKelas extends Model
{

    use SoftDeletes;

    protected $table = "paket_kelas";
    protected $primaryKey = 'id_paketkelas';

    public function paket()
    {
        return $this->hasOne('App\Models\PaketMember', 'id_paket', 'id_paket');
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id_kelas', 'id_kelas');
    }
}
