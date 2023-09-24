<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateSubStatusHistory extends BackendBaseModel
{
    use HasFactory, UserWiseFilter;
    protected $table ='candidate_sub_status_history';
    protected $fillable =['id','status','sub_status_id','status_applied_date','candidate_personal_information_id','remarks','created_by','updated_by'];
}
