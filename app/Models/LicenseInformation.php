<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LicenseInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='license_infos';
    protected $fillable =['id','candidate_info_id','license_no','license_type','issued_date','expirary_date','country','remarks','image','created_by','updated_by'];

}
