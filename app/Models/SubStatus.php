<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class SubStatus extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='sub_status';
    protected $fillable =['id','name','status','created_by','updated_by'];

    public function candidateDemands(){
        return $this->belongsToMany('App\Models\CandidateDemandJobInformation')->withPivot('id','status','remarks','demand_info_id');
    }

    public function candidateDemandHistory(){
        return $this->belongsToMany('App\Models\CandidateDemandHistory');
    }
}
