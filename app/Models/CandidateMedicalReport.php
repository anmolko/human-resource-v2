<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateMedicalReport extends BackendBaseModel
{
    use HasFactory, UserWiseFilter;
    protected $table ='can_medical_report';
    protected $fillable =['id','candidate_personal_information_id','complexion','check_medical','bloodgroup','height','weight','medical_report_number','health_clinic_id','report_issued_date','report_expiry_date','result','report','report_remarks','payment_status','amount','sub_status_id','remarks','status_applied_date','report_image','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
