<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationSchedule extends Model
{
    //
    protected $table = "invitation_schedules";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "name",
        "date",
        "start",
        "end",
        "location",
        "invitation"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';
}
