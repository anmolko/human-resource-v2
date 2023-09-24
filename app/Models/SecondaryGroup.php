<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class SecondaryGroup extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='secondary_groups';
    protected $fillable =['id','primary_group_id','name','slug','status','imported_from','created_by','updated_by'];


    public function primaryGroup(){
        return $this->belongsTo('App\Models\PrimaryGroup','primary_group_id','id')->with('attributes');
    }

    public function attributes(){
        return $this->belongsToMany('App\Models\Attribute')->with('SecondaryAttributes')->withTimestamps();
    }

    public function journalParticular(){
        return $this->hasMany('App\Models\JournalParticular');
    }

    public function secondaryAttributes(){
        return $this->hasMany('App\Models\SecondaryAttributes')->with('attributes');
    }



}
