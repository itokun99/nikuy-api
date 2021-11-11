<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    //
    use SoftDeletes;

    protected $table = "event";
    protected $primaryKey = 'id_event';

    public function penulis()
    {
        return $this->hasOne("App\Models\User", "id_user", "id_user");
    }
}
