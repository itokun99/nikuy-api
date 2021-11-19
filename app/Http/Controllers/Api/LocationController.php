<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;
use App\Models\City;
use App\Http\Resources\Location\ProvinceCollection;
use App\Http\Resources\Location\CityCollection;
use App\Http\Resources\Location\DistrictCollection;
use App\Http\Resources\Location\SubdistrictCollection;
use App\Models\District;
use App\Models\Subdistrict;

class LocationController extends Controller
{
    //

    public function getProvinces()
    {
        $data = Province::orderBy('prov_name', 'ASC')->get();
        return $this->responseSuccess(
            "Berhasil",
            200,
            new ProvinceCollection($data)
        );
    }

    public function getCities(Request $request)
    {
        $param = $request->get('province');

        if (!$request->has('province') || $param == '') {
            return $this->responseError('Pilih dulu provinsi', 400);
        }

        $data = City::orderBy('city_name', 'ASC')->where('prov_id', $param)->get();
        return $this->responseSuccess(
            "Berhasil",
            200,
            new CityCollection($data)
        );
    }

    public function getDistricts(Request $request)
    {
        $param = $request->get('city');

        if (!$request->has('city') || !$param || $param == '') {
            return $this->responseError('Pilih dulu kabupaten/kota', 400);
        }

        $data = District::orderBy('dis_name', 'ASC')->where('city_id', $param)->get();
        return $this->responseSuccess(
            "Berhasil",
            200,
            new DistrictCollection($data)
        );
    }

    public function getSubdistricts(Request $request)
    {
        $param = $request->get('district');

        if (!$request->has('district') || !$param || $param == '') {
            return $this->responseError('Pilih dulu kecamatan', 400);
        }

        $data = Subdistrict::orderBy('subdis_name', 'ASC')->where('dis_id', $param)->get();
        return $this->responseSuccess(
            "Berhasil",
            200,
            new SubdistrictCollection($data)
        );
    }
}
