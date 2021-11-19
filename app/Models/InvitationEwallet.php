<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationEwallet extends Model
{
    //
    protected $table = "invitation_ewallets";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "name",
        "akun",
        "qr",
        "invitation"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
}
