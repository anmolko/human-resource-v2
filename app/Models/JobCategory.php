<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='job_categories';
    protected $fillable =['id','name','description','status','created_by','updated_by'];

    public function jobsToDemand(){
        return $this->hasMany('App\Models\JobtoDemand');
    }

}
