<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationGallery extends Model
{
    //
    protected $table = "invitation_galleries";
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
