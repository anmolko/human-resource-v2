<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentVoucherParticulars extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table = 'paymentvoucher_particulars';
    protected $fillable = ['id', 'by_debit_id', 'to_credit_id', 'initial_acc_id', 'payment_voucher_id', 'debit_amount', 'credit_amount', 'status', 'created_by', 'updated_by'];


    public function paymentEntry()
    {
        return $this->belongsTo('App\Models\PaymentVoucher');
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
        return $this->belongsTo('App\Models\SecondaryGroup', 'by_debit_id', 'id')->with('primaryGroup');
    }

    public function credit()
    {
        return $this->belongsTo('App\Models\SecondaryGroup', 'to_credit_id', 'id')->with('primaryGroup');
    }

}
