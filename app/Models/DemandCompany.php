<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandCompany extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='demand_companies';
    protected $fillable =['id','title','email','phone','mobile','overseas_agent_id','address','fax_number','website','country','status','created_by','updated_by'];

    public function overseasAgent(){
        return $this->belongsTo('App\Models\OverseasAgent','overseas_agent_id', 'id');
    }

    public function demandCompanyCountryStates(){
        return $this->belongsToMany('App\Models\CountrySetting','company_country_states', 'demand_company_id','country_state_id');
    }
}
