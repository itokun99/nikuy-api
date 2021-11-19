<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationVideo extends Model
{
    //
    protected $table = "invitation_videos";
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
