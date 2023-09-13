<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LicenseInformation extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='license_infos';
    protected $fillable =['id','candidate_info_id','license_no','license_type','issued_date','expirary_date','country','remarks','image','created_by','updated_by'];

}
