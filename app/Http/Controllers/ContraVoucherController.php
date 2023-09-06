<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContraVoucherCreateRequest;
use App\Http\Requests\ContraVoucherUpdateRequest;
use App\Models\Attribute;
use App\Models\ContraVoucher;
use App\Models\ContraVoucherParticulars;
use App\Models\PrimaryGroup;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContraVoucherController extends Controller
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
        $contra_voucher = ContraVoucher::with('contraParticulars')->orderBy('date','desc')->get();
        return view('admin.contra_voucher.index',compact('contra_voucher'));
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
        $secondaryvalue       = SecondaryGroup::with('primaryGroup')
            ->whereHas('primaryGroup',function($query){
                $query->where('slug' , 'cash')->orWhere('slug' , 'bank');
            })->select('id','name')->get();

        return view('admin.contra_voucher.create',compact('secondaryvalue','all_attributes','primaryvalue'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContraVoucherCreateRequest $request)
    {
        $contra_entry = ContraVoucher::create([
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
                $contra_particulars = ContraVoucherParticulars::create([
                    'contra_voucher_id'=>$contra_entry->id,
                    'to_credit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[$debit_index],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,

                ]);
            }else{
                $contra_particulars = ContraVoucherParticulars::create([
                    'contra_voucher_id'=> $contra_entry->id,
                    'by_debit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[0],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,
                ]);
            }

        }

        if($contra_entry){
            Session::flash('success','Contra voucher Created Successfully');
        }
        else{
            Session::flash('error','Contra Voucher Creation Failed');
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
        $contra_voucher     = ContraVoucher::where('ref_no',$ref_no)->with('contraParticulars')->get();
        return view('admin.contra_voucher.show',compact('contra_voucher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editcontraentries    = ContraVoucher::where('ref_no',$id)->with('contraParticulars')->first();
        $secondaryvalue        = SecondaryGroup::with('primaryGroup')
            ->whereHas('primaryGroup',function($query){
                $query->where('slug', 'cash')->orWhere('slug', 'bank');
            })->select('id','name')->get();

        return view('admin.contra_voucher.edit',compact('secondaryvalue','editcontraentries'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContraVoucherUpdateRequest $request, $id)
    {
        $contravoucher               = ContraVoucher::find($id);
        $contravoucher->date         = date('Y-m-d',strtotime($request->input('date')));
        $contravoucher->narration    = $request->input('narration');
        $contravoucher->total_amount = $request->input('total_amount');
        $contravoucher->updated_by   = Auth::user()->id;
        $status = $contravoucher->update();

        $d_amount = $request->get('debit_amount');
        $c_amount = $request->get('credit_amount');
        $a_title = $request->get('account_title');
        $p_id = $request->get('particular_id');

        $count_credit = 0;
        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                if($length==2){
                    $count_credit = $key;
                    $credit_account_initial = ContraVoucherParticulars::where('id',$p_id[$key])->first();
                }
                else{
                    $debit_account_initial = ContraVoucherParticulars::where('id',$p_id[$key])->first();
                }
            }

        }

        $credit_index = $count_credit + 1 ;

        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                if($length==1){
                    $contra_particulars = ContraVoucherParticulars::updateOrCreate(
                        ['id' => $p_id[$key]],
                        [
                            'contra_voucher_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]
                    );
                }else{
                    $contra_particulars = ContraVoucherParticulars::updateOrCreate(
                        ['id' => $p_id[$key]],
                        [
                            'contra_voucher_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);
                }
            }else{
                if($length==2){
                    $contra_particulars = ContraVoucherParticulars::create(
                        [
                            'contra_voucher_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'initial_acc_id' =>$credit_account_initial->initial_acc_id,
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);

                }else{
                    $contra_particulars = ContraVoucherParticulars::create(
                        [
                            'contra_voucher_id' =>$id,
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
            Session::flash('success','Contra voucher Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Contra voucher could not be Updated');
        }
        return redirect()->route('contra-voucher.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletecontraentry  = ContraVoucher::find($id);
        $rid                 = $deletecontraentry->id;
        $check               = $deletecontraentry->contraParticulars()->get();
        if($check->count() == 0){
            $deletecontraentry->delete();
            return '#receipt_voucher'.$rid;
        }
        $checkdelete         = $deletecontraentry->contraParticulars()->delete();
        if ($checkdelete) {
            $deletecontraentry->delete();
        }else{
            return 0;
        }
        return '#contra_voucher'.$rid;
    }

    public function trashindex(){
        $trashed = ContraVoucher::onlyTrashed()->with('contraParticularsTrash')->get();
        return view('admin.contra_voucher.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval    = ContraVoucher::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        $check           = $trashremoval[0]->contraParticularsTrash()->get();
        if($check->count() == 0){
            ContraVoucher::onlyTrashed()->where('id', $id)->forceDelete();
            return '#contra-entry'.$rid;
        }
        $checkdelete = $trashremoval[0]->contraParticularsTrash()->forceDelete();
        if ($checkdelete) {
            ContraVoucher::onlyTrashed()->where('id', $id)->forceDelete();
        } else {
            return 0;
        }
        return  '#contra-entry'.$rid;
    }

    public function restoretrash($id){
        $restoretrash =  ContraVoucher::withTrashed()->find($id);

        $check = $restoretrash->contraParticularsTrash()->withTrashed()->get();
        if($check->count() == 0){
            $restoretrash->restore();
            Session::flash('success','Contra Voucher Restored');
            return redirect()->route('contra-voucher.trash');
        }
        $checkrestore = $restoretrash->contraParticulars()->withTrashed()->restore();
        if($checkrestore){
            $restoretrash->restore();
            Session::flash('success','Contra Voucher Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Contra Voucher could not be Restored');
        }
        return redirect()->route('contra-voucher.trash');
    }

    public function bankcheck(Request $request){
        if($request->ajax()){
            $one = SecondaryGroup::with('primaryGroup')->where('id',$request->value)->first();
            $confirm = 0;

            if($one->primaryGroup->slug == "bank"){
                $confirm = 1;
            }
            return response()->json($confirm);
        }
    }

    public function showprint($ref_no){
        $contra_voucher     = ContraVoucher::where('ref_no',$ref_no)->with('contraParticulars')->first();
        return view('admin.contra_voucher.individual',compact('contra_voucher'));
    }

}
