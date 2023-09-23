<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SecondaryGroup;
use App\Models\PrimaryGroup;
use App\Models\JournalEntry;
use App\Models\PaymentVoucher;
use App\Models\JournalParticular;
use App\Models\ReceiptVoucher;
use App\Models\ContraVoucher;
use App\Models\ThemeSetting;
use App\Models\CompanySetting;
use App\Models\PaymentVoucherParticulars;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class LedgerAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $secondary_groups = null;
    protected $primary_groups = null;
    protected $journal_entries = null;
    protected $journal_particulars = null;

    public function __construct(SecondaryGroup $secondary_groups,PrimaryGroup $primary_groups,JournalEntry $journal_entries,JournalParticular $journal_particulars)
    {
        $this->middleware('auth:web,agent');

        $this->secondary_groups     = $secondary_groups;
        $this->primary_groups       = $primary_groups;
        $this->journal_entries      = $journal_entries;
        $this->journal_particulars  = $journal_particulars;

    }


    public function index()
    {
        $secondaryvalue    = SecondaryGroup::select('id','name')->get();
        return view('admin.ledger.index',compact('secondaryvalue'));
    }

    public function ledgerType(Request $request)
    {
        $account = SecondaryGroup::find($request->input('account'));
        $account_id = $request->input('account');

        $themeDetail = ThemeSetting::first();
        $companyDetail = CompanySetting::first();

        if(@$themeDetail->default_date_format=='nepali'){
            $pieces = explode("-", $request->input('date_from'));
            $pieces_second = explode("-", $request->input('date_to'));
            $from =$pieces[2].' '.getNepaliMonth($pieces[1]).', '.$pieces[0];
            $to =$pieces_second[2].' '.getNepaliMonth($pieces_second[1]).', '.$pieces_second[0];
        }elseif(@$themeDetail->default_date_format=='english'){
            $from = date('j F, Y',strtotime($request->input('date_from')));
            $to = date('j F, Y',strtotime($request->input('date_to')));
        }else{
            $from = date('j F, Y',strtotime($request->input('date_from')));
            $to = date('j F, Y',strtotime($request->input('date_to')));
        }


        $data = JournalEntry::with('journalParticulars')
                ->whereHas('journalParticulars',function($query)use($account_id){
                    $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
                })
                ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();


        $journal_opening_data = JournalEntry::with('journalParticulars')
        ->whereHas('journalParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();



        $payment_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $payment_opening_data = PaymentVoucher::with('PaymentParticulars')
        ->whereHas('PaymentParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $receipt_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $receipt_opening_data = ReceiptVoucher::with('receiptParticulars')
        ->whereHas('receiptParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        $contra_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->whereBetween('date', [$request->input('date_from'), $request->input('date_to')])->orderBy('date','desc')->get();

        $contra_opening_data = ContraVoucher::with('contraParticulars')
        ->whereHas('contraParticulars',function($query)use($account_id){
            $query->where('by_debit_id', $account_id)->orWhere('to_credit_id', $account_id);
        })
        ->where('date','>=',$companyDetail->from)
        ->where('date', '<',$request->input('date_from'))->orderBy('date','desc')->get();


        return view('admin.ledger.individual',compact('contra_opening_data','journal_opening_data','payment_opening_data','receipt_opening_data','account','from','to','data','payment_data','receipt_data','contra_data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
