<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Model
{
    use SoftDeletes;
    protected $table ='modules';
    protected $fillable =['id','name','key','url','status','created_by','updated_by'];

    public function roles(){
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function permissions(){
        return $this->hasMany('App\Models\Permission');
    }
}
