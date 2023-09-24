<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class JournalEntry extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table ='journal_entries';
    protected $fillable =['id','ref_no','voucher_type','date','narration','total_amount','candidate_personal_id','processing_status','status','created_by','updated_by'];

    public function journalParticulars(){
        return $this->hasMany('App\Models\JournalParticular')->with(['debit','credit','initialAccount']);
    }

    public function journalParticularsTrash(){
        return $this->hasMany('App\Models\JournalParticular')->with(['debit','credit'])->onlyTrashed();
    }
}


