<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='demand_companies';
    protected $fillable =['id','title','email','phone','mobile','address','fax_number','website','country','status','created_by','updated_by'];



    public function overseasAgent(){
        return $this->belongsTo('App\Models\OverseasAgent','overseas_agent_id', 'id');
    }

    public function demandCompanyCountryStates(){
        return $this->belongsToMany('App\Models\CountrySetting','company_country_states', 'demand_company_id','country_state_id');
    }

}
