<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCourseProgress extends Model
{
    //
    use SoftDeletes;

    protected $table = 'user_course_progress';

    protected $fillable = [
        'id_user',
        'id_kursus'
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'id_user');
    }

    public function kursus()
    {
        return $this->hasOne('App\Models\Kursus', 'id', 'id_kursus');
    }
}
