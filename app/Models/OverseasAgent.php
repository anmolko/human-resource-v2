<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OverseasAgent extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='overseas_agents';
    protected $fillable =['id','client_no','type_of_company','company_name','company_address','country','country_state_id','company_contact_num','fax_num','company_email','website','postal_address','status','fullname','designation','personal_email','personal_mobile','personal_contact_num','image','created_by','updated_by'];

    public function demandInformation(){
        return $this->hasMany('App\Models\DemandInformation');
    }

    public function candidateDemandInfo(){
        return $this->hasMany('App\Models\CandidateDemandJobInformation');
    }

    public function candidateDemandHistory(){
        return $this->hasMany('App\Models\CandidateDemandHistory');
    }

    public function countryState(){
        return $this->belongsTo('App\Models\CountrySetting','country_state_id','id');
    }
}
