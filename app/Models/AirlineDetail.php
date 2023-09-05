<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AirlineDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='airline_details';
    protected $fillable =['id','reference_no','country','country_state_id','country_one','country_two','country_three','transaction','total_cost','remarks','created_by','updated_by'];

    public function countryState(){
        return $this->belongsTo('App\Models\CountrySetting','country_state_id','id');
    }

    public function ticketingagent(){
        return $this->belongsToMany('App\Models\TicketingAgent')->withTimestamps();
    }
}
