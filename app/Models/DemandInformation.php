<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='demand_informations';
    protected $fillable =['id','ref_no','serial_no','company_name','overseas_agent_id','country','country_state_id','address','telephone','fax_no','website','email','category','fulfill_date','issued_date','expired_date','advertised','status','doc_status','num_of_pax','doc_received_date','doc_status_remarks','image','created_by','updated_by'];

    public function jobs(){
        return $this->hasMany('App\Models\JobtoDemand')->with('jobCategory');
    }

    public function overseasAgent(){
        return $this->belongsTo('App\Models\OverseasAgent');
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
