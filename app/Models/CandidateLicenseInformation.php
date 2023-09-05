<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateLicenseInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='license_infos';
    protected $fillable =['id','candidate_personal_information_id','license_no','license_type','issued_date','expirary_date','country','remarks','image','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
