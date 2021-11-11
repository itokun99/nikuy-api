<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provinsi;
use App\Http\Resources\ProvinceCollection;

class ProvinceController extends Controller
{
    //
    public function getProvinces()
    {
        $provinces = Provinsi::orderBy('nama_provinsi', 'asc')->get();

        return new ProvinceCollection($provinces);
    }
}
