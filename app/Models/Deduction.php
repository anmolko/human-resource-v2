<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Deduction extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='deductions';
    protected $fillable =['id','payroll_id','deduction_name','deduction_month','deduction_amount','deduction_description','created_by','updated_by'];

    public function payroll(){
        return $this->belongsTo('App\Models\PayrollInformation','payroll_id','id')->with('employee');
    }



}
