<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthClinicInformation extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='health_clinic';
    protected $fillable =['id','name','address','country','email','contact','status','organization_name','membership_number','created_by','updated_by'];

}
