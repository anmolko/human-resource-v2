<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchOffice extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='branch_offices';
    protected $fillable =['id','ref_no','branch_office_name','address','contact_no','status','remarks','created_by','updated_by'];
    
    public function referenceInfo(){
        return $this->hasMany('App\Models\ReferenceInformation');
    }
}
