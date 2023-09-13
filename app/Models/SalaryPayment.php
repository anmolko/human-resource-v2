<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalaryPayment extends Model
{
    use HasFactory;
    use SoftDeletes , UserWiseFilter;

    protected $table ='salary_payment';
    protected $fillable =['id','payroll_id','basic_salary','gross_salary','total_deduction','net_salary','provident_fund','payment_amount','payment_month','secondary_group_id','note','created_by','updated_by'];

    public function payrolls()
    {
        return $this->belongsTo('App\Models\PayrollInformation','payroll_id','id')->with('employee');
    }
}
