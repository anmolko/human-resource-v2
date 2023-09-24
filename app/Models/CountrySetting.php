<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class CountrySetting extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='country_states';
    protected $fillable =['id','country','country_code','state','currency','created_by','updated_by'];

}
