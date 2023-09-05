<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateCV extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='candidate_cv';
    protected $fillable =['id','candidate_personal_information_id','profile','skill','duty','declaration','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
