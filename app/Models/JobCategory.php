<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='job_categories';
    protected $fillable =['id','name','description','status','created_by','updated_by'];

    public function jobsToDemand(){
        return $this->hasMany('App\Models\JobtoDemand');
    }

}
