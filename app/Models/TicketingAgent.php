<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketingAgent extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='ticketing_agent';
    protected $fillable =['id','agent_id','company_name','address','country','contact','fax_no','email','website','postal_address','fullname','designation','personal_contact','personal_mobile','personal_email','status','created_by','updated_by'];

    public function airline(){
        return $this->belongsToMany('App\Models\AirlineDetail')->withPivot('id');
    }
}
