<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Sosmed extends Model
{
    use SoftDeletes;

    protected $table = "sosmed";
    protected $primaryKey = 'id_sosmed';

    protected $fillable = [
        'nama_sosmed',
        'akun',
        'link_sosmed',
        'logo_sosmed',
    ];
}
