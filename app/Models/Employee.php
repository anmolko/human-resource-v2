<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='employees';
    protected $fillable =['id','user_id','father_name','mother_name','contact_no','emergency_contact','marital_status','department_id','designation_id','job_status','cv','citizenship','created_by','updated_by'];

    public function user(){
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function userTrash()
    {
        return $this->belongsTo('App\Models\User','user_id','id')->onlyTrashed();
    }
    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }

    public function designation(){
        return $this->belongsTo('App\Models\Designation','designation_id','id');
    }
    public function complainManaged(){
        return $this->hasMany('App\Models\ComplainManager');
    }

    public function payroll()
    {
        return $this->hasOne('App\Models\PayrollInformation');
    }
}


