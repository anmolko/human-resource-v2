<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateDocumentInformation extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='document_infos';
    protected $fillable =['id','candidate_personal_information_id','resume','original_passport','passport_xerox_copy','academic_certificates','original_academic','professional_training','work_certificates','medical_reports','original_driving_license','driving_license_copy','photographs','photograph_image','passport_image','signature_image','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
