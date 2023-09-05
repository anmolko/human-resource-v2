<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateProfessionalInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='professional_experiences';
    protected $fillable =['id','candidate_personal_information_id','job_ref_no','company_name','address','country','category_of_job','designation','document','duration','from','to','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
