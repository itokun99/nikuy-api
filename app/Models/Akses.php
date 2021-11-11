<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Akses extends Model
{
    //
    use SoftDeletes;

    protected $table = "akses";
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_user',
        'token'
    ];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user');
    }
}
