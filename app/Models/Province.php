<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Province extends Model
{

    use SoftDeletes;

    protected $table = "provinces";
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];
}
