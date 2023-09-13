<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptVoucher extends Model{
   use HasFactory;
   use SoftDeletes, UserWiseFilter;

    protected $table = 'receipt_vouchers';
    protected $fillable = ['id', 'ref_no', 'voucher_type', 'date', 'narration', 'total_amount', 'status', 'created_by', 'updated_by'];

    public function receiptParticulars()
{
    return $this->hasMany('App\Models\ReceiptVoucherParticulars')->with(['debit', 'credit','initialAccount']);
}

    public function receiptParticularsTrash()
{
    return $this->hasMany('App\Models\ReceiptVoucherParticulars')->with(['debit', 'credit'])->onlyTrashed();
}
}
