<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Http\Resources\BannerCollection;
use App\Http\Resources\BannerKelasCollection;
use App\Models\BannerKelas;
use App\Models\BannerKelasKursus;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Slider::whereIn('kondisi', ['POSTING'])
            ->orderBy('order', 'ASC')
            ->get();

        return new BannerCollection($banners);
    }

    public function bannerKelas()
    {
        $bannerKelas = BannerKelas::with(['items.kursus' => function ($q) {
            $q->with(['paket', 'pilar']);
        }, 'kelas.paket_kelas'])
            ->whereIn('kondisi', ['POSTING'])
            ->orderBy('order', 'ASC')
            ->get();


        return new BannerKelasCollection($bannerKelas);
    }
}
