<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalParticular extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table ='journal_particulars';
    protected $fillable =['id','by_debit_id','to_credit_id','initial_acc_id','journal_entry_id','debit_amount','credit_amount','status','created_by','updated_by'];


    public function journalEntry(){
        return $this->belongsTo('App\Models\JournalEntry');
    }

    public function primaryGroup(){
        return $this->belongsTo('App\Models\PrimaryGroup');
    }

    
    public function initialAccount(){
        return $this->belongsTo('App\Models\SecondaryGroup','initial_acc_id','id');
    }

    public function debit(){
        return $this->belongsTo('App\Models\SecondaryGroup','by_debit_id','id')->with('primaryGroup');
    }

    public function credit(){
        return $this->belongsTo('App\Models\SecondaryGroup','to_credit_id','id')->with('primaryGroup');
    }

}
