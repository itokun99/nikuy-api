<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invitation extends Model
{
    //
    protected $table = "invitations";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "title",
        "url",
        "description",
        "author",
        "status"
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';


    public function user()
    {
        return $this->hasOne("App\Models\User", "id", "author");
    }

    public function couples()
    {
        return $this->hasMany("App\Models\InvitationCouple", "invitation", "id");
    }

    public function schedules()
    {
        return $this->hasMany("App\Models\InvitationSchedule", "invitation", "id");
    }

    public function galleries()
    {
        return $this->hasMany("App\Models\InvitationGallery", "invitation", "id");
    }

    public function videos()
    {
        return $this->hasMany("App\Models\InvitationVideo", "invitation", "id");
    }

    public function rekening()
    {
        return $this->hasMany("App\Models\InvitationRekening", "invitation", "id");
    }

    public function ewallets()
    {
        return $this->hasMany("App\Models\InvitationEwallet", "invitation", "id");
    }

    public function location()
    {
        return $this->hasOne("App\Models\InvitationLocation", "invitation_id", "id");
    }

    public function image()
    {
        return $this->hasOne("App\Models\InvitationImage", "invitation", "id");
    }
}
