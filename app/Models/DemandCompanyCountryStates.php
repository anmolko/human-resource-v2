<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class DemandCompanyCountryStates extends BackendBaseModel
{
    use HasFactory;

    protected $table = 'company_country_states';
    protected $fillable = ['id','demand_company_id','country_state_id'];

    public function countryState(){
        return $this->belongsTo('App\Models\CountrySetting','country_state_id','id');
    }

    public function demandCompany(){
        return $this->belongsTo('App\Models\DemandCompany','demand_company_id', 'id');
    }

}
