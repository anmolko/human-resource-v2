<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;
    protected $table ='roles';
    //this sepcifies the table to be used by the model

    protected $fillable =['id','name','status','created_by','updated_by'];
    //this specifies the data that can be added to the columns of table roles.

    public function users(){
        return $this->belongsToMany('App\Models\User')->withTimestamps();
    }
    public function modules(){
        return $this->belongsToMany('App\Models\Module')->with('permissions')->withTimestamps();
    }
    public function permissions(){
        return $this->belongsToMany('App\Models\Permission')->withTimestamps();
    }
}
