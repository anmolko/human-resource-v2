<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InsuranceAgent extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='insurance_agents';
    protected $fillable =['id','company_name','company_address','country','company_contact_num','company_email','status','personal_fullname','personal_designation','personal_contact_num','personal_mobile_num','personal_email','created_by','updated_by'];
}



