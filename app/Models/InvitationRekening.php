<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationRekening extends Model
{
    //
    protected $table = "invitation_rekening";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "rekening",
        "bank",
        "owner",
        "invitation"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
}
