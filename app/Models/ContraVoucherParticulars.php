<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContraVoucherParticulars extends Model
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table = 'contravoucher_particulars';
    protected $fillable = ['id', 'by_debit_id', 'to_credit_id', 'initial_acc_id', 'contra_voucher_id', 'debit_amount', 'credit_amount', 'status', 'created_by', 'updated_by'];

    public function contraEntry()
    {
        return $this->belongsTo('App\Models\ContraVoucher');
    }

    public function primaryGroup()
    {
        return $this->belongsTo('App\Models\PrimaryGroup');
    }

    public function initialAccount(){
        return $this->belongsTo('App\Models\SecondaryGroup','initial_acc_id','id');
    }

    public function debit()
    {
        return $this->belongsTo('App\Models\SecondaryGroup', 'by_debit_id', 'id');
    }

    public function credit()
    {
        return $this->belongsTo('App\Models\SecondaryGroup', 'to_credit_id', 'id');
    }
}
