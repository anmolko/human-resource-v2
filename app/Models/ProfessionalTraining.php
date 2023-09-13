<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ProfessionalTraining extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='professional_trainings';
    protected $fillable =['id','candidate_info_id','certificate_no','institute_name','training_type','certificate','country','duration','created_by','updated_by'];

}
