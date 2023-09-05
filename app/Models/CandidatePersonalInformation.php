<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatePersonalInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='candidate_personal_info';
    protected $fillable =['id','registration_no','serial_no','status','image','registration_date_ad','registration_date_bs','passport_no','birth_place','issued_date','expiry_date','reference_information_id','reference_amount','receipt_no','document_processing_fee','advance_fee','candidate_firstname','candidate_middlename','candidate_lastname','age','next_of_kin','kin_relationship','kin_contact_no','gender','nationality','religion','date_of_birth','mobile_no','contact_no','martial_status','spouse','children','email_address','height','weight','father_name','father_contact_no','mother_name','mother_contact_no','permanent_address','temporary_address','aboard_contact_no','candidate_type','created_by','updated_by'];


    public function cvInfo(){
        return $this->hasOne('App\Models\CandidateCV');
    }

    public function professionalInfo(){
        return $this->hasMany('App\Models\CandidateProfessionalInformation');
    }

    public function trainingInfo(){
        return $this->hasMany('App\Models\CandidateProfessionalTraining');
    }

    public function qualificationInfo(){
        return $this->hasMany('App\Models\CandidateQualificationInformation');
    }

    public function languageInfo(){
        return $this->hasMany('App\Models\CandidateLanguageInformation');
    }

    public function documentInfo(){
        return $this->hasMany('App\Models\CandidateDocumentInformation');
    }

    public function licenseInfo(){
        return $this->hasMany('App\Models\CandidateLicenseInformation');
    }

    public function bankInfo(){
        return $this->hasMany('App\Models\CandidateBankInformation');
    }
    //candidate related demand
    public function demandJobInfo(){
        return $this->hasOne('App\Models\CandidateDemandJobInformation')->with('demandInfo','overseasInfo','jobtoDemand');
    }

    //candidate related demand history if the process is reapplied
    public function demandJobHistory(){
        return $this->hasOne('App\Models\CandidateDemandHistory')->with('demandInfo','overseasInfo','jobtoDemand');
    }


    public function complainsList(){
        return $this->hasMany('App\Models\complain_manager');
    }

    public function visa()
    {
        return $this->hasOne('App\Models\CandidateVisaInformation');
    }

    public function visa_stamping()
    {
        return $this->hasOne('App\Models\VisaStamp');
    }

    public function referenceInfo(){
        return $this->belongsTo('App\Models\ReferenceInformation','reference_information_id','id');
    }

    public function medical_report()
    {
        return $this->hasOne('App\Models\CandidateMedicalReport','candidate_personal_information_id','id');
    }

    public function individual_ticket()
    {
        return $this->hasOne('App\Models\CandidateIndividualTicketing');
    }
}
