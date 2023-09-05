<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;
    protected $table ='permissions';
    protected $fillable =['id','module_id','name','key','status','created_by','updated_by'];

    public function roles(){
        return $this->belongsToMany('App\Models\Role')->withTimestamps();
    }

    public function module(){
        return $this->belongsTo('App\Models\Module');
    }
}
