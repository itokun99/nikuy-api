<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserPreneur extends Model
{

    use SoftDeletes;

    protected $table = "user_preneur";
    protected $primaryKey = 'id_userpreneur';

    public function user()
    {
        return $this->belongsTo('App\Models\User', "id_user", "id_user");
    }

    public function province()
    {

        return $this->hasOne('App\Models\Provinsi', 'id_provinsi', 'id_provinsi');
    }
}
