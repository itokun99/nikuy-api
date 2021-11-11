<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Provinsi extends Model
{

    use SoftDeletes;

    protected $table = "provinsi";
    protected $primaryKey = 'id_provinsi';

    protected $fillable = [
        'nama_provinsi',
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User', 'provinsi', 'id_provinsi');
    }
}
