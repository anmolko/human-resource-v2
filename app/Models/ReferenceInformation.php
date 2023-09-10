<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReferenceInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='reference_informations';
    protected $fillable =['id','reference_name','optional_name','branch_office_id','company','country','address','contact_no','mobile_no','email_address','identification_image','status','image','name_of_organization','membership_no','created_by','updated_by'];

    public function branchOffice(){
        return $this->belongsTo('App\Models\BranchOffice','branch_office_id','id');
    }

    public function candidateInfo(){
        return $this->hasMany('App\Models\CandidatePersonalInformation');
    }
}
