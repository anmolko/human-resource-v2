<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandInformation extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;


    protected $table ='demand_informations';
    protected $fillable =['id','ref_no','serial_no','demand_company_id','country_state_id','category','fulfill_date','issued_date','expired_date','advertised','status','doc_status','num_of_pax','doc_received_date','doc_status_remarks','image','created_by','updated_by'];

    public function jobs(){
        return $this->hasMany('App\Models\JobtoDemand')->with('jobCategory');
    }

    public function demandCompany(){
        return $this->belongsTo('App\Models\DemandCompany','demand_company_id')->with('overseasAgent');
    }

    public function countryState(){
        return $this->belongsTo('App\Models\CountrySetting','country_state_id','id');
    }

    public function candidateDemand(){
        return $this->hasMany('App\Models\CandidateDemandJobInformation');
    }

    public function candidateDemandHistory(){
        return $this->hasMany('App\Models\CandidateDemandHistory');
    }
}
