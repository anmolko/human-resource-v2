<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateQualificationInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='qualification_infos';
    protected $fillable =['id','candidate_personal_information_id','school_college_name','document','academic_level','address','completed_on','division','result','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
