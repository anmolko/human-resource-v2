<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchOffice extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='branch_offices';
    protected $fillable =['id','ref_no','branch_office_name','address','contact_no','status','remarks','created_by','updated_by'];

    public function referenceInfo(){
        return $this->hasMany('App\Models\ReferenceInformation');
    }
}
