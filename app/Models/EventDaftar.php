<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class EventDaftar extends Model
{
    //
    use SoftDeletes;

    protected $table = "event_daftar";
    protected $primaryKey = 'id_daftar';

    protected $fillable = [
        'id_user',
        'id_event'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user')->withTrashed();
    }

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id_event', 'id_event')->withTrashed();
    }
}
