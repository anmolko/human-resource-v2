<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CompanySetting extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='company_settings';
    protected $fillable =['id','company_name','slug','company_address','company_license','extra_header','application_selected','letterhead','email','phone','mobile','company_logo','pan_number','from','to','created_by','updated_by'];

}
