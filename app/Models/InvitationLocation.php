<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvitationLocation extends Model
{
    //
    //
    protected $table = "invitation_locations";
    protected $primaryKey = 'id';

    public $incrementing = false;

    protected $fillable = [
        "id",
        "province_id",
        "city_id",
        "district_id",
        "subdistrict_id",
        "address",
        "postal_code",
        "googlemap",
        "invitation_id"
    ];

    protected $casts = [
        'id' => 'string'
    ];

    protected $keyType = 'string';

    public function  province()
    {
        return $this->hasOne("App\Models\Province", "prov_id", "province_id");
    }

    public function  city()
    {
        return $this->hasOne("App\Models\City", "city_id", "city_id");
    }

    public function  district()
    {
        return $this->hasOne("App\Models\District", "dis_id", "district_id");
    }

    public function  subdistrict()
    {
        return $this->hasOne("App\Models\Subdistrict", "subdis_id", "subdistrict_id");
    }
}
