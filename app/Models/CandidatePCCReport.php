<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidatePCCReport extends Model
{
    use HasFactory, SoftDeletes, UserWiseFilter;
    protected $table    ='can_pcc_report';
    protected $fillable = ['id','candidate_personal_information_id','issued','stamping_date','country','registration_number','expiry_date','image','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }}
