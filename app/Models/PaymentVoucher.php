<?php
namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class PaymentVoucher extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table = 'payment_vouchers';
    protected $fillable = ['id', 'ref_no', 'voucher_type', 'date', 'narration', 'total_amount', 'status', 'created_by', 'updated_by'];

    public function PaymentParticulars()
    {
        return $this->hasMany('App\Models\PaymentVoucherParticulars')->with(['debit', 'credit','initialAccount']);
    }

    public function paymentParticularsTrash()
    {
        return $this->hasMany('App\Models\PaymentVoucherParticulars')->with(['debit', 'credit'])->onlyTrashed();
    }
}


