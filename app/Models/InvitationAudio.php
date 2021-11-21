<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationAudio extends Model
{
    //
    protected $table = "invitation_audio";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "url",
        "invitation"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
}
