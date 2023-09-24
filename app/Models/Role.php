<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Role extends BackendBaseModel
{
    use SoftDeletes;
    protected $table ='roles';
    //this sepcifies the table to be used by the model

    protected $fillable =['id','name','key','status','created_by','updated_by'];
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

    public function changeToSlug($name){
        return Str::slug($name, '-');
    }
}
