<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationInformation extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='qualification_infos';
    protected $fillable =['id','candidate_info_id','school_college_name','academic_level','address','completed_on','division','result','created_by','updated_by'];

}
