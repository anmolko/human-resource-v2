<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Increment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='increments';
    protected $fillable =['id','payroll_id','month','amount','purpose','created_by','updated_by'];
    
    public function payroll(){
        return $this->belongsTo('App\Models\PayrollInformation','payroll_id','id')->with('employee');
    }
}
