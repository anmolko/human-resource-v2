<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DemandInformation extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table ='demand_informations';
    protected $fillable =['id','ref_no','serial_no','demand_company_id','category','fulfill_date','issued_date','expired_date','advertised','status','doc_status','num_of_pax','doc_received_date','doc_status_remarks','image','created_by','updated_by'];

    public function jobs(){
        return $this->hasMany('App\Models\JobtoDemand')->with('jobCategory');
    }

    public function demandCompany(){
        return $this->belongsTo('App\Models\DemandCompany','demand_company_id');
    }

    public function candidateDemand(){
        return $this->hasMany('App\Models\CandidateDemandJobInformation');
    }

    public function candidateDemandHistory(){
        return $this->hasMany('App\Models\CandidateDemandHistory');
    }
}
