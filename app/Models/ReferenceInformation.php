<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceInformation extends Model
{
    use HasFactory;
    use SoftDeletes , UserWiseFilter;
    protected $table ='reference_informations';
    protected $fillable =['id','role_id','reference_name','optional_name','branch_office_id','company','country','address','contact_no','mobile_no','email','identification_image','status','image','name_of_organization','membership_no','created_by','updated_by'];

    public function branchOffice(){
        return $this->belongsTo('App\Models\BranchOffice','branch_office_id','id');
    }

    public function candidateInfo(){
        return $this->hasMany('App\Models\CandidatePersonalInformation');
    }

    public function role(){
        return $this->belongsTo('App\Models\Role')->with('permissions','modules');
    }
}
