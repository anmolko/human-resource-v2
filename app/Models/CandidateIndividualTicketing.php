<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateIndividualTicketing extends Model
{
    use HasFactory;
    protected $table ='can_individual_tickets';
    protected $fillable =['id','candidate_personal_information_id','ticket_no','airline_id','booking_description','booking_date','booking_time','ticketing_agent_id','status_applied_date','remarks','sub_status_id','created_by','updated_by'];

    public function personalInfo(){
        return $this->belongsTo('App\Models\CandidatePersonalInformation','candidate_personal_information_id','id');
    }

    public function airlineInfo(){
        return $this->belongsTo('App\Models\AirlineDetail','airline_id','id');
    }


    public function subStatusInfo(){
        return $this->belongsTo('App\Models\SubStatus','sub_status_id','id');
    }
}
