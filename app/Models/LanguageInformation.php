<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class LanguageInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='language_infos';
    protected $fillable =['id','candidate_info_id','language','speaking','reading','writing','created_by','updated_by'];

}
