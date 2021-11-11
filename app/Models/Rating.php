<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Rating extends Model
{
    use SoftDeletes;
    protected $table = "rating_kelas";
    protected $primaryKey = 'id_rating';

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user')->withTrashed();
    }

    public function kelas()
    {
        return $this->hasOne('App\Models\Kelas', 'id_kelas', 'id_kelas')->withTrashed();
    }
}
