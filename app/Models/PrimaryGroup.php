<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PrimaryGroup extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='primary_groups';
    protected $fillable =['id','name','classfication','nature','slug','status','created_by','updated_by'];

    public function secondaryGroups(){
        return $this->hasMany('App\Models\SecondaryGroup');
    }

    public function attributes(){
        return $this->belongsToMany('App\Models\Attribute')->with('SecondaryAttributes')->withTimestamps();
    }


}
