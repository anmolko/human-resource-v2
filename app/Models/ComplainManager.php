<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ComplainManager extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table = 'complain_manager';
    protected $fillable = ['id', 'candidate_info_id', 'passport_num', 'job_category', 'company', 'contact_person', 'regd_by','employee_id','type','priority','subject','message','regd_date','status','solved_date', 'created_by', 'updated_by'];

    public function candidateInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_info_id','id');
    }
    public function employeeInfo(){
        return $this->belongsTo('App\Models\Employee','employee_id','id')->with('user');
    }
}
