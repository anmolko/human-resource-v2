<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Folder extends BackendBaseModel
{
    use HasFactory , UserWiseFilter;

    protected $table ='folders';
    protected $fillable =['id','candidate_id','folder_name','created_by','updated_by'];


    public function candidate(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_id','id')->withTrashed();
    }
}
