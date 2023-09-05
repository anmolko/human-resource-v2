<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='departments';
    protected $fillable =['id','name','description','status','created_by','updated_by'];

    public function designation(){
        return $this->hasMany('App\Models\Designation');
    }
}
