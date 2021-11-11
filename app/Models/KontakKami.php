<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KontakKami extends Model
{
    protected $table = "kontak_kami";
    protected $primaryKey = 'id_kontak';

    protected $fillable = [
        'subyek',
        'nama_kontak',
        'email',
        'deskripsi',
        'status'
    ];
}
