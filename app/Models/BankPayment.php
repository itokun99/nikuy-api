<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BankPayment extends Model
{
    //
    use SoftDeletes;

    protected $table = "bank_payment";
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_bank', 'no_rekening', 'pemilik_rekening', 'deskripsi', 'status'
    ];
}
