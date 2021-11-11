<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{

    use SoftDeletes;

    protected $table = "transaksi";
    protected $primaryKey = 'id_transaksi';

    protected $fillable = [
        "id_transaksi",
        "nama_transaksi",
        "no_rek",
        "bank_asal",
        "nama_rekening",
        "tgl_transaksi",
        "tgl_berakhir",
        "id_paket",
        "id_event",
        "id_user",
        "biaya_transaksi",
        "keterangan",
        "baca_admin",
        "baca_member",
        "foto_struk",
        "pesan"
    ];

    public function user()
    {
        return $this->hasOne('App\Models\User', 'id_user', 'id_user')->withTrashed();
    }

    public function paket()
    {
        return $this->hasOne('App\Models\PaketMember', 'id_paket', 'id_paket')->withTrashed();
    }

    public function event()
    {
        return $this->hasOne('App\Models\Event', 'id_event', 'id_event')->withTrashed();
    }
}
