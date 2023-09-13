<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='designations';
    protected $fillable =['id','name','department_id','description','status','created_by','updated_by'];

    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }
}
