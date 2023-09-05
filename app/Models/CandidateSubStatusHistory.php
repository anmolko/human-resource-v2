<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateSubStatusHistory extends Model
{
    use HasFactory;
    protected $table ='candidate_sub_status_history';
    protected $fillable =['id','status','sub_status_id','status_applied_date','candidate_personal_information_id','remarks','created_by','updated_by'];
}
