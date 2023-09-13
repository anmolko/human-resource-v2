<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;

class AdvertisingAgent extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='advertising_agent';
    protected $fillable =['id','registration_no','company_name','address','country','contact','email','fullname','designation','personal_contact','personal_mobile','personal_email','status','created_by','updated_by'];



}
