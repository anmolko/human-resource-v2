<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualificationInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='qualification_infos';
    protected $fillable =['id','candidate_info_id','school_college_name','academic_level','address','completed_on','division','result','created_by','updated_by'];

}
