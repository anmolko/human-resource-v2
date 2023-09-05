<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HealthClinicInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='health_clinic';
    protected $fillable =['id','name','address','country','email','contact','status','organization_name','membership_number','created_by','updated_by'];

}
