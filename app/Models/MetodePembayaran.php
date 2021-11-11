<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MetodePembayaran extends Model
{
    //
    use SoftDeletes;

    protected $table = "metode_pembayaran";
    protected $primaryKey = 'id';
    protected $fillable = [
        'tipe',
        'id_bank',
        'rekening',
        'pemilik',
        'deskripsi',
        'status'
    ];

    public function bank()
    {
        return $this->hasOne('App\Models\Bank', 'id', 'id_bank');
    }
}
