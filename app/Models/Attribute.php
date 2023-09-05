<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='attributes';
    protected $fillable =['id','name','slug','field_type','status','created_by','updated_by'];

    public function secondaryGroups(){
        return $this->belongsToMany('App\Models\SecondaryGroup')->withTimestamps();
    }
    public function primaryGroup(){
        return $this->belongsToMany('App\Models\PrimaryGroup')->withTimestamps();
    }
    public function SecondaryAttributes(){
        return $this->hasMany('App\Models\SecondaryAttributes');
    }
}
