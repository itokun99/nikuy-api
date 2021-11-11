<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserPaket extends Model
{
    use SoftDeletes;

    protected $table = 'user_paket';

    protected $fillable = [
        'id_user', 'id_paket', 'subscribe_at', 'expired_at'
    ];


    public function user()
    {
        return $this->hasOne("App\Models\User", "id_user", "id_user");
    }

    public function paket()
    {
        return $this->hasOne("App\Models\PaketMember", "id_paket", "id_paket");
    }
}
