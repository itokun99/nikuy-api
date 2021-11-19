<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationCouple extends Model
{
    //
    protected $table = "invitation_couples";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "name",
        "description",
        "photo",
        "invitation"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
}
