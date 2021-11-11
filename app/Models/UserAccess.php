<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserAccess extends Model
{
    //
    use SoftDeletes;

    protected $table = "user_access";
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'token'
    ];


    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
}
