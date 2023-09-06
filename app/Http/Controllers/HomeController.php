<?php

namespace App\Http\Controllers;

use App\Models\CandidatePersonalInformation;
use App\Models\ContraVoucher;
use App\Models\DemandInformation;
use App\Models\ReceiptVoucher;
use App\Models\JournalEntry;
use App\Models\OverseasAgent;
use App\Models\PaymentVoucher;
use App\Models\ReferenceInformation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // session()->put('role_id',Auth::user()->roles[0]->id);
        $recent_user    = User::with('roles')->orderBy('created_at','desc')->limit(5)->get();
        $contra_voucher = ContraVoucher::with('contraParticulars')->orderBy('created_at','desc')->limit(5)->get();
        $payment_voucher = PaymentVoucher::with('PaymentParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $receipt_voucher = ReceiptVoucher::with('receiptParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $all_roles = Role::latest()->get();
        $journal_total = JournalEntry::count();
        $receipt_total = ReceiptVoucher::count();
        $payment_total = PaymentVoucher::count();
        $contra_total = ContraVoucher::count();
        return view('dashboard',compact('journal_total','receipt_total','payment_total','contra_total','recent_user','all_roles','contra_voucher','payment_voucher','receipt_voucher'));
    }

    public function account()
    {
        abort(404);
        // session()->put('role_id',Auth::user()->roles[0]->id);
        $recent_user    = User::with('roles')->orderBy('created_at','desc')->limit(5)->get();
        $contra_voucher = ContraVoucher::with('contraParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $payment_voucher = PaymentVoucher::with('PaymentParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $receipt_voucher = ReceiptVoucher::with('receiptParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $journal_entry = JournalEntry::with('journalParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $all_roles = Role::latest()->get();
        $journal_total = JournalEntry::count();
        $receipt_total = ReceiptVoucher::count();
        $payment_total = PaymentVoucher::count();
        $contra_total = ContraVoucher::count();
        return view('account_dashboard',compact('journal_entry','journal_total','receipt_total','payment_total','contra_total','recent_user','all_roles','contra_voucher','payment_voucher','receipt_voucher'));
    }

    public function candidate()
    {
        // session()->put('role_id',Auth::user()->roles[0]->id);
        $overseas_agent    = OverseasAgent::orderBy('created_at','desc')->limit(3)->get();
        $demand_information = DemandInformation::orderBy('created_at','desc')->limit(3)->get();
        $candidate_information = CandidatePersonalInformation::orderBy('created_at','desc')->limit(3)->get();
        $reference_information = ReferenceInformation::orderBy('created_at','desc')->limit(3)->get();
        $all_roles = Role::latest()->get();
        $reference_total = ReferenceInformation::count();
        $candidate_total = CandidatePersonalInformation::count();
        $demand_total = DemandInformation::count();
        $overseas_total = OverseasAgent::count();

        return view('candidate_dashboard',compact('candidate_total','reference_total','demand_total','overseas_total','overseas_agent','all_roles','demand_information','reference_information','candidate_information'));
    }


    public function entry()
    {
        // session()->put('role_id',Auth::user()->roles[0]->id);
        $overseas_agent    = OverseasAgent::orderBy('created_at','desc')->limit(3)->get();
        $demand_information = DemandInformation::orderBy('created_at','desc')->limit(3)->get();
        $candidate_information = CandidatePersonalInformation::orderBy('created_at','desc')->limit(3)->get();
        $reference_information = ReferenceInformation::orderBy('created_at','desc')->limit(3)->get();
        $all_roles = Role::latest()->get();
        $reference_total = ReferenceInformation::count();
        $candidate_total = CandidatePersonalInformation::count();
        $demand_total = DemandInformation::count();
        $overseas_total = OverseasAgent::count();

        return view('entry_dashboard',compact('candidate_total','reference_total','demand_total','overseas_total','overseas_agent','all_roles','demand_information','reference_information','candidate_information'));
    }

    public function processing()
    {
        $overseas_agent    = OverseasAgent::orderBy('created_at','desc')->limit(3)->get();
        $demand_information = DemandInformation::orderBy('created_at','desc')->limit(3)->get();
        $candidate_information = CandidatePersonalInformation::orderBy('created_at','desc')->limit(3)->get();
        $reference_information = ReferenceInformation::orderBy('created_at','desc')->limit(3)->get();
        $all_roles = Role::latest()->get();
        $reference_total = ReferenceInformation::count();
        $candidate_total = CandidatePersonalInformation::count();
        $demand_total = DemandInformation::count();
        $overseas_total = OverseasAgent::count();

        return view('processing_dashboard',compact('candidate_total','reference_total','demand_total','overseas_total','overseas_agent','all_roles','demand_information','reference_information','candidate_information'));
    }


    public function user()
    {
        // session()->put('role_id',Auth::user()->roles[0]->id);
        $recent_user    = User::with('roles')->orderBy('created_at','desc')->limit(5)->get();
        $contra_voucher = ContraVoucher::with('contraParticulars')->orderBy('created_at','desc')->limit(5)->get();
        $payment_voucher = PaymentVoucher::with('PaymentParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $receipt_voucher = ReceiptVoucher::with('receiptParticulars')->orderBy('created_at','desc')->limit(3)->get();
        $all_roles = Role::latest()->get();
        $journal_total = JournalEntry::count();
        $receipt_total = ReceiptVoucher::count();
        $payment_total = PaymentVoucher::count();
        $contra_total = ContraVoucher::count();
        return view('user_dashboard',compact('journal_total','receipt_total','payment_total','contra_total','recent_user','all_roles','contra_voucher','payment_voucher','receipt_voucher'));
    }
}

