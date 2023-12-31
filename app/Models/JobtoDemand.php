<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobtoDemand extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='jobs_to_demands';
    protected $fillable =['id','job_category_id','demand_information_id','job_status','requirements','min_qualification','contact_period','working','holidays','hours','salary','category_amount','commission_amount','overtime_per_month','currency','accommodation','food_facilities','ticket','overtime','medical_in','medical_company','insurance_in','insurance_company','remarks','levy','levy_amount','created_by','updated_by'];

    public function demandInformation(){
        return $this->belongsTo('App\Models\DemandInformation')->with('demandCompany');
    }

    public function jobCategory(){
        return $this->belongsTo('App\Models\JobCategory');
    }

    public function candidateDemandJob(){
        return $this->hasMany('App\Models\CandidateDemandJobInformation');
    }

    public function candidateDemandHistory(){
        return $this->hasMany('App\Models\CandidateDemandHistory');
    }
}
