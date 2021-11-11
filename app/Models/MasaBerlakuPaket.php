<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasaBerlakuPaket extends Model
{
    //
    use SoftDeletes;

    protected $table = 'masa_berlaku_paket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'jumlah_masa', 'tipe_masa', 'status'
    ];
}
