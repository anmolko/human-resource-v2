<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CandidateBankInformation extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;
    protected $table ='bank_infos';
    protected $fillable =['id','candidate_personal_information_id','bank_details','cheque_image','bank_remarks','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }
}
