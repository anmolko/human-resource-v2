<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='document_infos';
    protected $fillable =['id','candidate_info_id','resume','original_passport','passport_xerox_copy','academic_certificates','professional_training','work_certificates','medical_reports','original_driving_license','driving_license_copy','photographs','photograph_image','passport_image','signature_image','created_by','updated_by'];

}
