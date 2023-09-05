<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Designation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='designations';
    protected $fillable =['id','name','department_id','description','status','created_by','updated_by'];
    
    public function department(){
        return $this->belongsTo('App\Models\Department','department_id','id');
    }
}
