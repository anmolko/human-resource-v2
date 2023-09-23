<?php

namespace App\Http\Controllers;

use App\Http\Requests\JournalEntryCreateRequest;
use App\Http\Requests\JournalEntryUpdateRequest;
use App\Models\JournalEntry;
use App\Models\JournalParticular;
use App\Models\SecondaryGroup;
use App\Models\Attribute;
use App\Models\PrimaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class JournalEntryController extends Controller
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
        $journal_entries = JournalEntry::with('journalParticulars')->orderBy('date','desc')->get();
        return view('admin.journal_entry.index',compact('journal_entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $primaryvalue         = PrimaryGroup::select('id','name')->get();
        $secondaryvalue       = SecondaryGroup::select('id','name')->get();
        $all_attributes       = Attribute::latest()->get();
        return view('admin.journal_entry.create',compact('secondaryvalue','primaryvalue','all_attributes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JournalEntryCreateRequest $request)
    {
        $journal_entry = JournalEntry::create([
            'date' =>      $request->input('date'),
            'ref_no'        =>$request->input('ref_no'),
            'narration'        =>$request->input('narration'),
            'total_amount'        =>$request->input('total_amount'),
            'created_by' =>Auth::user()->id,
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
                $journary_particulars = JournalParticular::create([
                    'journal_entry_id'=> $journal_entry->id,
                    'by_debit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[$credit_index],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,

                ]);
            }else{
                $journary_particulars = JournalParticular::create([
                    'journal_entry_id'=> $journal_entry->id,
                    'to_credit_id' =>$a_title[$key],
                    'initial_acc_id' =>$a_title[0],
                    'debit_amount' =>$d_amount[$key],
                    'credit_amount' =>$c_amount[$key],
                    'created_by' =>Auth::user()->id,

                ]);
            }

        }


        if($journal_entry){
            Session::flash('success','Journal Entry Created Successfully');
        }
        else{
            Session::flash('error','Journal Entry Creation Failed');
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
        $singlejournalentry     = JournalEntry::where('ref_no',$ref_no)->with('journalParticulars')->get();

        return view('admin.journal_entry.show',compact('singlejournalentry'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editjournalentries     = JournalEntry::where('ref_no',$id)->with('journalParticulars')->first();
        $secondaryvalue       = SecondaryGroup::select('id','name')->get();
        return view('admin.journal_entry.edit', compact('editjournalentries','secondaryvalue'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(JournalEntryUpdateRequest $request, $id)
    {

        $journalentry               = JournalEntry::find($id);
        $journalentry->date         = date('Y-m-d',strtotime($request->input('date')));
        $journalentry->narration    = $request->input('narration');
        $journalentry->total_amount    = $request->input('total_amount');
        $journalentry->updated_by = Auth::user()->id;
        $status=$journalentry->update();

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
                    $debit_account_initial = JournalParticular::where('id',$p_id[$key])->first();
                }
                else{
                    $credit_account_initial =JournalParticular::where('id',$p_id[$key])->first();
                }
            }

        }

        $credit_index = $count_debit + 1 ;

        foreach($request->get('drcr') as $key => $length){
            if(isset($p_id[$key])){
                    if($length==1){
                        $journary_particulars = JournalParticular::updateOrCreate(
                            ['id' => $p_id[$key]],
                            [
                            'journal_entry_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]
                    );
                    }else{
                        $journary_particulars = JournalParticular::updateOrCreate(
                            ['id' => $p_id[$key]],
                            [
                            'journal_entry_id' =>$id,
                            'to_credit_id' =>$a_title[$key],
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]);
                    }
                }else{
                    if($length==1){
                        $journary_particulars = JournalParticular::create(
                            [
                            'journal_entry_id' =>$id,
                            'by_debit_id' =>$a_title[$key],
                            'initial_acc_id' =>$debit_account_initial->initial_acc_id,
                            'debit_amount' =>$d_amount[$key],
                            'credit_amount' =>$c_amount[$key],
                            'created_by' =>Auth::user()->id,
                            'updated_by' =>Auth::user()->id,

                        ]
                    );
                    }else{
                        $journary_particulars = JournalParticular::create(
                            [
                            'journal_entry_id' =>$id,
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




        if($status ){
            Session::flash('success','Journal Entry Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Journal Entry could not be Updated');
        }
        return redirect()->route('journal-entry.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletejournalentry = JournalEntry::find($id);
        $rid             = $deletejournalentry->id;
        $check = $deletejournalentry->journalParticulars()->get();
        if($check->count() == 0){
            $deletejournalentry->delete();
            return '#journal_entry'.$rid;
        }

        $checkdelete = $deletejournalentry->journalParticulars()->delete();
        if ($checkdelete) {
            $deletejournalentry->delete();

        }else{
            return 0;
        }
        return '#journal_entry'.$rid;
    }

    public function trashindex(){
        $trashed = JournalEntry::onlyTrashed()->with('journalParticularsTrash')->get();
        return view('admin.journal_entry.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = JournalEntry::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;

        $check = $trashremoval[0]->journalParticulars()->get();
        if($check->count() == 0){
            JournalEntry::onlyTrashed()->where('id', $id)->forceDelete();
            return '#journal_entry'.$rid;
        }

        $checkdelete = $trashremoval[0]->journalParticulars()->forceDelete();
          if ($checkdelete) {
            JournalEntry::onlyTrashed()->where('id', $id)->forceDelete();

        } else {
            return 0;

        }
         return  '#journal_entry'.$rid;


    }



    public function restoretrash($id){
        $restoretrash =  JournalEntry::withTrashed()->find($id);

        $check = $restoretrash->journalParticulars()->withTrashed()->get();
        if($check->count() == 0){
            $restoretrash->restore();
            Session::flash('success','Journal Entry Restored');
            return redirect()->route('journal-entry.trash');
        }

        $checkrestore = $restoretrash->journalParticulars()->withTrashed()->restore();

        if($checkrestore){
            $restoretrash->restore();
            Session::flash('success','Journal Entry Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Journal Entry could not be Restored');
        }
        return redirect()->route('journal-entry.trash');
    }

    public function showprint($ref_no){
        $journal_voucher     = JournalEntry::where('ref_no',$ref_no)->with('journalParticulars')->first();
        return view('admin.journal_entry.individual',compact('journal_voucher'));
    }
}
