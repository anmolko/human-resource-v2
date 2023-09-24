<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertisingAgent extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='advertising_agent';
    protected $fillable =['id','registration_no','company_name','address','country','contact','email','fullname','designation','personal_contact','personal_mobile','personal_email','status','created_by','updated_by'];

}
