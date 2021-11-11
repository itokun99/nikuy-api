<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerKelas extends Model
{
    //
    use SoftDeletes;
    protected $table = 'banner_kelas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul', 'id_kelas', 'gambar', 'order', 'kondisi'
    ];

    public function kelas()
    {
        return $this->hasOne("App\Models\Kelas", "id_kelas", "id_kelas");
    }

    public function items()
    {
        return $this->hasMany("App\Models\BannerKelasKursus", "id_banner_kelas", "id");
    }
}
