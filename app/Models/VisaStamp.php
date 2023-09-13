<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaStamp extends Model
{
    use HasFactory, UserWiseFilter;
    protected $table ='visa_stamps';
    protected $fillable =['id','candidate_personal_information_id','stamping_forward_date','stamping_collection_date','visa_stamp_remarks','job_to_demand_id','remarks','sub_status_id','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }

    public function jobDemandInfo(){
        return $this->belongsTo('App\Models\JobtoDemand','job_to_demand_id','id');
    }

    public function subStatusInfo(){
        return $this->belongsTo('App\Models\SubStatus','sub_status_id','id');
    }
}
