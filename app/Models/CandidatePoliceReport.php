<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatePoliceReport extends Model
{
    use HasFactory, SoftDeletes;
    protected $table    ='can_police_report';
    protected $fillable = ['id','candidate_personal_information_id','issued','stamping_date','registration_number','expiry_date','image','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
