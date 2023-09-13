<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Counsellor extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='counsellors';
    protected $fillable =['id','overseas_agent_id','description','response','response_via','misc','created_by','updated_by'];

    public function agent(){
        return $this->belongsTo('App\Models\OverseasAgent','overseas_agent_id','id');
    }
}
