<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PayrollInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payrolls';
    protected $fillable = ['id', 'employee_id', 'employee_type','basic_salary','house_rent_allowance','medical_allowance','special_allowance', 'provident_fund_contribution', 'other_allowance', 'tax_deduction','provident_fund_deduction','other_deduction','total_provident_fund','net_salary','gross_salary','created_by', 'updated_by'];

    public function employee()
    {
        return $this->belongsTo('App\Models\Employee')->with(['user','designation','department']);
    }

    public function salaryPayment()
    {
        return $this->hasMany('App\Models\SalaryPayment');
    }
}
