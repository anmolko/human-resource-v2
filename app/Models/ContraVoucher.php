<?php

namespace App\Models;

use App\Traits\UserWiseFilter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContraVoucher extends BackendBaseModel
{
    use HasFactory;
    use SoftDeletes, UserWiseFilter;

    protected $table = 'contra_vouchers';
    protected $fillable = ['id', 'ref_no', 'voucher_type', 'date', 'narration', 'total_amount', 'status', 'created_by', 'updated_by'];

    public function contraParticulars()
    {
        return $this->hasMany('App\Models\ContraVoucherParticulars')->with(['debit', 'credit','initialAccount']);
    }

    public function contraParticularsTrash()
    {
        return $this->hasMany('App\Models\ContraVoucherParticulars')->with(['debit', 'credit'])->onlyTrashed();
    }
}
