<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentVoucherCreateRequest;
use App\Http\Requests\PaymentVoucherUpdateRequest;
use App\Models\Attribute;
use App\Models\PaymentVoucher;
use App\Models\PaymentVoucherParticulars;
use App\Models\PrimaryGroup;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Expr\Print_;

class PaymentVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:web,agent');

    }


    public function index()
    {
        $payment_voucher = PaymentVoucher::with('PaymentParticulars')->orderBy('date','desc')->get();
        return view('admin.payment_voucher.index',compact('payment_voucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_attributes       = Attribute::latest()->get();
        $primaryvalue         = PrimaryGroup::select('id','name')->get();
        $secondaryvalue    = SecondaryGroup::with('primaryGroup')
            ->whereHas('primaryGroup',function($query){
                    $query->where('slug', '!=' , 'bank')->Where('slug', '!=' , 'cash');
            })->select('id','name')->get();

        $credit      = SecondaryGroup::with('primaryGroup')
            ->orderBy('created_by','desc')->get();
        return view('admin.payment_voucher.create',compact('secondaryvalue','credit','primaryvalue','all_attributes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentVoucherCreateRequest $request)
    {
        $payment_entry = PaymentVoucher::create([
            'date'         => $request->input('date'),
            'ref_no'       => $request->input('ref_no'),
            'narration'    => $request->input('narration'),
            'total_amount' => $request->input('total_amount'),
            'created_by'   => Auth::user()->id,
        ]);
        $d_amount = $request->get('debit_amount');
        $c_amount = $request->get('credit_amount');
        $a_title = $request->get('account_title');

        $count_debit = 0;
        $credit_index =0;
        foreach($request->get('drcr') as $key => $length){
            if($length==1){
                $count_debit = $key;
            }

        }

        $credit_index = $count_debit + 1 ;
        foreach($request->get('drcr') as $key => $length){
            if($length==1){
                $payment_particulars = PaymentVoucherParticulars::create([
                    'payment_voucher_id'=> $payment_entry->id,
                    'by_debit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[$credit_index],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,

                ]);
            }else{
                $payment_particulars = PaymentVoucherParticulars::create([
                    'payment_voucher_id'=> $payment_entry->id,
                    'to_credit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[0],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,

                ]);
            }

        }

        if($payment_entry){
            Session::flash('success','Payment voucher Created Successfully');
        }
        else{
            Session::flash('error','Payment Voucher Creation Failed');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ref_no)
    {
        $payment_voucher     = PaymentVoucher::where('ref_no',$ref_no)->with('PaymentParticulars')->get();
        return view('admin.payment_voucher.show',compact('payment_voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editpaymententries    = PaymentVoucher::where('ref_no',$id)->with('PaymentParticulars')->first();
        $secondaryvalue    = SecondaryGroup::with('primaryGroup')
            ->whereHas('primaryGroup',function($query){
                $query->where('slug', '!=' , 'bank')->Where('slug', '!=' , 'cash');
            })->select('id','name')->get();

        $credit      = SecondaryGroup::with('primaryGroup')
            ->orderBy('created_by','desc')->get();
        return view('admin.payment_voucher.edit',compact('editpaymententries','secondaryvalue','credit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PaymentVoucherUpdateRequest $request, $id)
    {

        $paymentvoucher               = PaymentVoucher::find($id);
        $paymentvoucher->date         = date('Y-m-d',strtotime($request->input('date')));
        $paymentvoucher->narration    = $request->input('narration');
        $paymentvoucher->total_amount = $request->input('total_amount');
        $paymentvoucher->updated_by   = Auth::user()->id;
        $status = $paymentvoucher->update();

        $d_amount = $request->get('debit_amount');
        $c_amount = $request->get('credit_amount');
        $a_title = $request->get('account_title');
        $p_id = $request->get('particular_id');

        $count_debit = 0;
        $credit_index =0;
        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                if($length==1){
                    $count_debit = $key;
                    $debit_account_initial = PaymentVoucherParticulars::where('id',$p_id[$key])->first();
                }
                else{
                    $credit_account_initial = PaymentVoucherParticulars::where('id',$p_id[$key])->first();
                }
            }

        }

        $credit_index = $count_debit + 1 ;

        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                if($length==1){
                    $payment_particulars = PaymentVoucherParticulars::updateOrCreate(
                        ['id' => $p_id[$key]],
                        [
                            'payment_voucher_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]
                    );
                }else{
                    $payment_particulars = PaymentVoucherParticulars::updateOrCreate(
                        ['id' => $p_id[$key]],
                        [
                            'payment_voucher_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);
                }
            }else{
                if($length==1){
                    $payment_particulars = PaymentVoucherParticulars::create(
                        [
                            'payment_voucher_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'initial_acc_id' =>$debit_account_initial->initial_acc_id,
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]
                    );
                }else{
                    $payment_particulars = PaymentVoucherParticulars::create(
                        [
                            'payment_voucher_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'initial_acc_id' =>$credit_account_initial->initial_acc_id,
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);
                }
            }
        }

        if($status){
            Session::flash('success','Payment voucher Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Payment voucher could not be Updated');
        }
        return redirect()->route('payment-voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletepaymententry  = PaymentVoucher::find($id);
        $rid                 = $deletepaymententry->id;
        $check               = $deletepaymententry->PaymentParticulars()->get();
        if($check->count() == 0){
            $deletepaymententry->delete();
            return '#payment_voucher'.$rid;
        }
        $checkdelete         = $deletepaymententry->PaymentParticulars()->delete();
        if ($checkdelete) {
            $deletepaymententry->delete();
        }else{
            return 0;
        }
        return '#payment_voucher'.$rid;
    }

    public function trashindex(){
        $trashed = PaymentVoucher::onlyTrashed()->with('paymentParticularsTrash')->get();
        return view('admin.payment_voucher.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  PaymentVoucher::withTrashed()->find($id);

        $check = $restoretrash->PaymentParticulars()->withTrashed()->get();
        if($check->count() == 0){
            $restoretrash->restore();
            Session::flash('success','Payment Voucher Restored');
            return redirect()->route('payment-voucher.trash');
        }
        $checkrestore = $restoretrash->PaymentParticulars()->withTrashed()->restore();
        if($checkrestore){
            $restoretrash->restore();
            Session::flash('success','Payment Voucher Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Payment Voucher could not be Restored');
        }
        return redirect()->route('payment-voucher.trash');
    }

    public function deletetrash($id){
        $trashremoval    = PaymentVoucher::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        $check = $trashremoval[0]->PaymentParticulars()->get();
        if($check->count() == 0){
            PaymentVoucher::onlyTrashed()->where('id', $id)->forceDelete();
            return '#payment-entry'.$rid;
        }
        $checkdelete = $trashremoval[0]->PaymentParticulars()->forceDelete();
        if ($checkdelete) {
            PaymentVoucher::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            return 0;
        }
        return  '#payment-entry'.$rid;
    }

    public function creditcheck(Request $request){
        if($request->ajax()){
            $credit_id = $request->credit_id;
            $confirm = 0;
            foreach ($credit_id as $cr){
                $one = SecondaryGroup::with('primaryGroup')->where('id',$cr)->get();
                foreach($one as $p){
                    if($p->primaryGroup->slug == "cash" || $p->primaryGroup->slug == "bank" ){
                        $confirm = 1;
                    }
                }
            }
            return response($confirm);
        }
    }

    public function showprint($ref_no){
        $payment_voucher     = PaymentVoucher::where('ref_no',$ref_no)->with('PaymentParticulars')->first();
        return view('admin.payment_voucher.individual',compact('payment_voucher'));
    }

}
