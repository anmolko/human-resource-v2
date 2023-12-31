<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateCV extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='candidate_cv';
    protected $fillable =['id','candidate_personal_information_id','profile','skill','duty','declaration','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
