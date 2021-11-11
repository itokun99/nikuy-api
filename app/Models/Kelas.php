<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Kelas extends Model
{

    use SoftDeletes;

    protected $table = "kelas";
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'id_kelas',
        'nama_kelas',
        'deskripsi',
        'foto_kelas',
        'kondisi',
        'pesan',
        'order_id',
    ];

    public function kursus()
    {
        return $this->hasMany('App\Models\Kursus', 'id_kelas', 'id_kelas');
    }

    public function paket_kelas()
    {
        return $this->hasMany('App\Models\PaketKelas', 'id_kelas', 'id_kelas');
    }

    public function pilar()
    {
        return $this->hasMany('App\Models\Pilar', 'id_kelas', 'id_kelas');
    }
}
