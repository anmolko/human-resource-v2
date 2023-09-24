<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ThemeSetting extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='theme_settings';
    protected $fillable =['id','website_name','logo','favicon','color','currency','default_date_format','created_by','updated_by'];

}
