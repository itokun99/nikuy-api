<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationImage extends Model
{
    //
    protected $table = "invitation_images";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "cover",
        "thumbnail",
        "invitation"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
}
