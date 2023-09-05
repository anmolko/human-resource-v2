<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateVisaInformation extends Model
{
    use HasFactory;
    protected $table ='candidate_visa_info';
    protected $fillable =['id','candidate_personal_information_id','visa_number','visa_ref_number','demand_info_id','job_to_demand_id','visa_type','purpose','issue_date','expiry_date','residency_duration','remarks','image','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }

}
