<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Visitor extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='visitors';
    protected $fillable =['id','employee_id','visitor_id','visitor_name','mobile_no','reason','misc','image','created_by','updated_by'];

    public function employee(){
        return $this->belongsTo('App\Models\Employee','employee_id','id')->with(['user','designation']);
    }
}

