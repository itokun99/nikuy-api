<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KursusFile extends Model
{

    use SoftDeletes;

    protected $table = "kursus_file";
    protected $primaryKey = 'id_kursus';

    public function paket()
    {
        return $this->hasOne("App\Models\PaketMember", "id_paket", "id_paket");
    }

    public function kelas()
    {
        return $this->hasOne("App\Models\Kelas", "id_kelas", "id_kelas");
    }

    public function pilar()
    {
        return $this->hasOne("App\Models\Pilar", "id_pilar", "id_pilar");
    }
}
