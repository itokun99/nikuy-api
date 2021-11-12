<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use SoftDeletes, Notifiable;

    protected $table = "users";
    protected $primaryKey = 'id';

    protected $fillable = [
        "id",
        "name",
        "username",
        "address",
        "province",
        "dob",
        "gender",
        "phone",
        "email",
        "password",
        "photo",
        "role",
        "status",
    ];

    public $incrementing = false;

    protected $casts = [
        'id' => 'string'
    ];
    protected $keyType = 'string';

    public function province()
    {
        return $this->hasOne("App\Models\Province", 'id', 'province');
    }

    public function access()
    {
        return $this->hasOne("App\Models\UserAccess", "user_id", "id");
    }
}
