<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pilar extends Model
{

    use SoftDeletes;

    protected $table = "pilar";
    protected $primaryKey = 'id_pilar';

    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id_kelas', 'id_kelas');
    }

    public function kursus()
    {
        return $this->hasMany('App\Models\Kursus', 'id_pilar', 'id_pilar');
    }
}
