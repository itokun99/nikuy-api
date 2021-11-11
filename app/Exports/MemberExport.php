<?php

namespace App\Exports;

use App\user;
use Maatwebsite\Excel\Concerns\FromCollection;

class MemberExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return user::all();
    }
    
    public static function selection()
    {
        return user::all();
        // return user::where(['hak_akses' => 'Member'])->get();
    }
}
