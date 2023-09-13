<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BankInformation extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='bank_infos';
    protected $fillable =['id','candidate_info_id','bank_details','cheque_image','bank_remarks','created_by','updated_by'];
}
