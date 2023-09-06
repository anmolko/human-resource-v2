<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchOfficeCreateRequest;
use App\Http\Requests\BranchOfficeUpdateRequest;
use App\Models\BranchOffice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;;

class BranchOfficeController extends Controller
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
        $branchoffices = BranchOffice::latest()->get();
        return view('admin.branch_office.index',compact('branchoffices'));

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
    public function store(BranchOfficeCreateRequest $request)
    {

        $branch = BranchOffice::create([
            'ref_no'               =>$request->input('ref_no'),
            'status'               =>$request->input('status'),
            'branch_office_name'   =>$request->input('branch_office_name'),
            'address'              =>$request->input('address'),
            'contact_no'           =>$request->input('contact_no'),
            'remarks'              =>$request->input('remarks'),
            'created_by'           =>Auth::user()->id,
        ]);
        if($branch){
            Session::flash('success','Branch Office Created Successfully');
        }
        else{
            Session::flash('error','Branch Office Creation Failed');
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = BranchOffice::find($id);
        return response()->json(['show'=>$show]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editbranch     = BranchOffice::find($id);
        return response()->json($editbranch);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BranchOfficeUpdateRequest $request, $id)
    {
        $branch                         = BranchOffice::find($id);
        $branch->ref_no                 = $request->input('ref_no');
        $branch->branch_office_name     = $request->input('branch_office_name');
        $branch->status                 = $request->input('status');
        $branch->address                = $request->input('address');
        $branch->contact_no             = $request->input('contact_no');
        $branch->remarks                = $request->input('remarks');
        $branch->updated_by             = Auth::user()->id;
        $status                         = $branch->update();
        if($status){
            Session::flash('success','Branch Office Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Branch Office could not be Updated');
        }
        return redirect()->route('branch-office.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletebranch = BranchOffice::find($id);
        $rid             = $deletebranch->id;
        $checkReference = $deletebranch->referenceInfo()->get();
        if ($checkReference->count() > 0) {
            return 0;

        }else{

             $deletebranch->delete();
        }
        return '#branch'.$rid;
    }


    public function trashindex(){
        $trashed = BranchOffice::onlyTrashed()->get();
        return view('admin.branch_office.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = BranchOffice::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;
        $checkReference    = $trashremoval[0]->referenceInfo()->get();
        if ($checkReference->count() > 0 ) {

            return 0;
        } else {
            BranchOffice::onlyTrashed()->where('id', $id)->forceDelete();

        }
         return  '#branch'.$rid;


    }

    public function restoretrash($id){
        $restoretrash =  BranchOffice::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Branch Office Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Branch Office could not be Restored');
        }
        return redirect()->route('branch-office.trash');
    }

    public function statusupdate(Request $request, $id){
        $branch          = BranchOffice::find($id);
        $branch->status  = $request->status;
        $status        = $branch->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
