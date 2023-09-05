<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateDemandJobInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='demand_job_infos';
    protected $fillable =['id','candidate_personal_information_id','job_category_id','demand_info_id','job_to_demand_id','overseas_agent_id','skills','salary','issued_date','status_applied_date','interview_date','interview_remarks','receivable_salary','num_of_pax','sub_status_id','remarks','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id')->with('individual_ticket','medical_report');
    }

    public function demandInfo(){
        return $this->belongsTo('App\Models\DemandInformation','demand_info_id','id')->with('countryState');
    }

    public function overseasInfo(){
        return $this->belongsTo('App\Models\OverseasAgent','overseas_agent_id','id');
    }

    public function jobtoDemand(){
        return $this->belongsTo('App\Models\JobtoDemand','job_to_demand_id','id')->with('jobCategory');
    }

}
