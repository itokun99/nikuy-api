<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerKelasKursus extends Model
{
    //
    use SoftDeletes;
    protected $table = 'banner_kelas_kursus';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_banner_kelas', 'id_kursus', 'order', 'kondisi'
    ];


    public function banner_kelas()
    {
        return $this->hasOne('App\Models\BannerKelas', 'id_banner_kelas', 'id');
    }

    public function kursus()
    {
        return $this->hasOne('App\Models\Kursus', 'id_kursus', 'id_kursus');
    }
}
