<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Increment extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='increments';
    protected $fillable =['id','payroll_id','month','amount','purpose','created_by','updated_by'];

    public function payroll(){
        return $this->belongsTo('App\Models\PayrollInformation','payroll_id','id')->with('employee');
    }
}
