<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubStatusCreateRequest;
use App\Http\Requests\SubStatusUpdateRequest;
use App\Models\SubStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SubStatusController extends Controller
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
         $substatus = SubStatus::latest()->get();
        return view('admin.sub_status.index',compact('substatus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubStatusCreateRequest $request)
    {
        $substatus = SubStatus::create([
            'name'        =>$request->input('name'),
            'status'      =>$request->input('status'),
            'created_by' =>Auth::user()->id,
        ]);
        if($substatus){
            Session::flash('success','Sub Status Created Successfully');
        }
        else{
            Session::flash('error','Sub Status Creation Failed');
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
        $editstatus    = SubStatus::find($id);
        return response()->json($editstatus);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubStatusUpdateRequest $request, $id)
    {
        $substatus               = SubStatus::find($id);
        $substatus->name         = $request->input('name');
        $substatus->status       = $request->input('status');
        $substatus->updated_by   = Auth::user()->id;
        $status                 = $substatus->update();
        if($status){
            Session::flash('success','Sub Status Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Sub Status could not be Updated');
        }
        return redirect()->route('sub-status.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletesubstatus  = SubStatus::find($id);
        $rid             = $deletesubstatus->id;
        $deletesubstatus->delete();
        return '#sub_status_'.$rid;
    }

    public function trashindex(){
        $trashed = SubStatus::onlyTrashed()->get();
        return view('admin.sub_status.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  SubStatus::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Sub Status Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Sub Status could not be Restored');
        }
        return redirect()->route('sub-status.trash');
    }

    public function deletetrash($id){
        $trashremoval = SubStatus::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        SubStatus::onlyTrashed()->where('id', $id)->forceDelete();
         return  '#sub_status'.$rid;
    }
}
