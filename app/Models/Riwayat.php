<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Riwayat extends Model
{
    //
    protected $table = 'riwayat';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user', 'deskripsi', 'tipe', 'detail'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }
}
