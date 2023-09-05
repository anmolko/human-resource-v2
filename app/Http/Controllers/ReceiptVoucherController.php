<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReceiptVoucherCreateRequest;
use App\Http\Requests\ReceiptVoucherUpdateRequest;
use App\Models\Attribute;
use App\Models\PrimaryGroup;
use App\Models\ReceiptVoucher;
use App\Models\ReceiptVoucherParticulars;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ReceiptVoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $receipt_voucher = ReceiptVoucher::with('receiptParticulars')->orderBy('date','desc')->get();
        return view('admin.receipt_voucher.index',compact('receipt_voucher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_attributes       = Attribute::all();
        $primaryvalue         = PrimaryGroup::select('id','name')->get();
        $secondaryvalue    = SecondaryGroup::with('primaryGroup')
            ->whereHas('primaryGroup',function($query){
                $query->where('slug', '!=' , 'bank')->Where('slug', '!=' , 'cash');
            })->select('id','name')->get();

        $debit      = SecondaryGroup::with('primaryGroup')
            ->orderBy('created_by','desc')->get();
        return view('admin.receipt_voucher.create',compact('secondaryvalue','debit','primaryvalue','all_attributes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReceiptVoucherCreateRequest $request)
    {
        $receipt_entry = ReceiptVoucher::create([
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
        $debit_index =0;
        foreach($request->get('drcr') as $key => $length){
            if($length==2){
                $count_debit = $key;
            }

        }
        $debit_index = $debit_index + 1 ;
        foreach($request->get('drcr') as $key => $length){
            if($length==2){
                $receipt_particulars = ReceiptVoucherParticulars::create([
                    'receipt_voucher_id'=> $receipt_entry->id,
                    'to_credit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[$debit_index],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,

                ]);

            }else{
                $receipt_particulars = ReceiptVoucherParticulars::create([
                    'receipt_voucher_id'=> $receipt_entry->id,
                    'by_debit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[0],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,
                ]);
            }

        }

        if($receipt_entry){
            Session::flash('success','Receipt voucher Created Successfully');
        }
        else{
            Session::flash('error','Receipt Voucher Creation Failed');
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
        $receipt_voucher     = ReceiptVoucher::where('ref_no',$ref_no)->with('receiptParticulars')->get();
        return view('admin.receipt_voucher.show',compact('receipt_voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editreceiptentries    = ReceiptVoucher::where('ref_no',$id)->with('receiptParticulars')->first();
        $secondaryvalue        = SecondaryGroup::with('primaryGroup')
                                    ->whereHas('primaryGroup',function($query){
                                        $query->where('slug', '!=' , 'bank')->Where('slug', '!=' , 'cash');
                                    })->select('id','name')->get();
        $debit                 = SecondaryGroup::with('primaryGroup')
                                     ->orderBy('created_by','desc')->get();
        return view('admin.receipt_voucher.edit',compact('secondaryvalue','debit','editreceiptentries'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ReceiptVoucherUpdateRequest $request, $id)
    {
        $receiptvoucher               = ReceiptVoucher::find($id);
        $receiptvoucher->date         = date('Y-m-d',strtotime($request->input('date')));
        $receiptvoucher->narration    = $request->input('narration');
        $receiptvoucher->total_amount = $request->input('total_amount');
        $receiptvoucher->updated_by   = Auth::user()->id;
        $status = $receiptvoucher->update();

        $d_amount = $request->get('debit_amount');
        $c_amount = $request->get('credit_amount');
        $a_title = $request->get('account_title');
        $p_id = $request->get('particular_id');

        $count_credit = 0;
        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                if($length==2){
                    $count_credit = $key;
                    $credit_account_initial = ReceiptVoucherParticulars::where('id',$p_id[$key])->first();
                }
                else{
                    $debit_account_initial = ReceiptVoucherParticulars::where('id',$p_id[$key])->first();
                }
            }

        }

        $credit_index = $count_credit + 1 ;

        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                if($length==1){
                    $receipt_particulars = ReceiptVoucherParticulars::updateOrCreate(
                        ['id' => $p_id[$key]],
                        [
                            'receipt_voucher_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]
                    );
                }else{
                    $receipt_particulars = ReceiptVoucherParticulars::updateOrCreate(
                        ['id' => $p_id[$key]],
                        [
                            'receipt_voucher_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);
                }
            }else{
                if($length==2){
                    $receipt_particulars = ReceiptVoucherParticulars::create(
                        [
                            'receipt_voucher_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'initial_acc_id' =>$credit_account_initial->initial_acc_id,
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);

                }else{
                    $receipt_particulars = ReceiptVoucherParticulars::create(
                        [
                            'receipt_voucher_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'initial_acc_id' =>$debit_account_initial->initial_acc_id,
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,
                        ]
                    );
                }
            }
        }

        if($status){
            Session::flash('success','Receipt voucher Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Receipt voucher could not be Updated');
        }
        return redirect()->route('receipt-voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletereceiptentry  = ReceiptVoucher::find($id);
        $rid                 = $deletereceiptentry->id;
        $check               = $deletereceiptentry->receiptParticulars()->get();
        if($check->count() == 0){
            $deletereceiptentry->delete();
            return '#receipt_voucher'.$rid;
        }
        $checkdelete         = $deletereceiptentry->receiptParticulars()->delete();
        if ($checkdelete) {
            $deletereceiptentry->delete();
        }else{
            return 0;
        }
        return '#receipt_voucher'.$rid;
    }

    public function trashindex(){
        $trashed = ReceiptVoucher::onlyTrashed()->with('receiptParticularsTrash')->get();
        return view('admin.receipt_voucher.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  ReceiptVoucher::withTrashed()->find($id);

        $check = $restoretrash->receiptParticularsTrash()->withTrashed()->get();
        if($check->count() == 0){
            $restoretrash->restore();
            Session::flash('success','Receipt Voucher Restored');
            return redirect()->route('receipt-voucher.trash');
        }
        $checkrestore = $restoretrash->receiptParticulars()->withTrashed()->restore();
        if($checkrestore){
            $restoretrash->restore();
            Session::flash('success','Receipt Voucher Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Receipt Voucher could not be Restored');
        }
        return redirect()->route('receipt-voucher.trash');
    }

    public function deletetrash($id){
        $trashremoval    = ReceiptVoucher::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        $check = $trashremoval[0]->receiptParticulars()->get();
        if($check->count() == 0){
            ReceiptVoucher::onlyTrashed()->where('id', $id)->forceDelete();
            return '#receipt-entry'.$rid;
        }
        $checkdelete = $trashremoval[0]->receiptParticulars()->forceDelete();
        if ($checkdelete) {
            ReceiptVoucher::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            return 0;
        }
        return  '#receipt-entry'.$rid;
    }

    public function debitcheck(Request $request){
        if($request->ajax()){
            $debit_id = $request->debit_id;
            $confirm = 0;
            foreach ($debit_id as $cr){
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
        $receipt_voucher     = ReceiptVoucher::where('ref_no',$ref_no)->with('receiptParticulars')->first();
        return view('admin.receipt_voucher.individual',compact('receipt_voucher'));
    }
}
