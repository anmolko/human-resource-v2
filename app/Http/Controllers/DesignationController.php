<?php

namespace App\Http\Controllers;

use App\Http\Requests\DesignationCreateRequest;
use App\Http\Requests\DesignationUpdateRequest;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::all();
        $departments = Department::where('status','1')->get();
        return view('admin.designation.index',compact('designations','departments'));
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
    public function store(DesignationCreateRequest $request)
    {
        $designation = Designation::create([
            'name'              =>$request->input('name'),
            'department_id'     =>$request->input('department_id'),
            'description'       =>$request->input('description'),
            'status'            =>$request->input('status'),
            'created_by'        =>Auth::user()->id,
        ]);
        if($designation){
            Session::flash('success','Designation Created Successfully');
        }
        else{
            Session::flash('error','Designation Creation Failed');
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
        $editdesignation    = Designation::with('department')->find($id);
        return response()->json($editdesignation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DesignationUpdateRequest $request, $id)
    {
        $designation               = Designation::find($id);
        $designation->name         = $request->input('name');
        $designation->department_id         = $request->input('department_id');
        $designation->status       = $request->input('status');
        $designation->description  = $request->input('description');
        $designation->updated_by   = Auth::user()->id;
        $status                 = $designation->update();
        if($status){
            Session::flash('success','Designation Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Designation could not be Updated');
        }
        return redirect()->route('designation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedesignation = Designation::find($id);
        $rid             = $deletedesignation->id;
        // $checkEmployee = $deletedesignation->employee()->get();
        // if ($checkEmployee->count() > 0) {
        //     return 0;

        // }else{

             $deletedesignation->delete();
        // }
        return '#designation'.$rid;
    }

    public function trashindex(){
        $trashed = Designation::onlyTrashed()->get();
        return view('admin.designation.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = Designation::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;
        // $checkEmployee    = $trashremoval[0]->employee()->get();
        // if ($checkEmployee->count() > 0 ) {
        
        //     return 0;
        // } else {
            Designation::onlyTrashed()->where('id', $id)->forceDelete();

        // }
         return  '#designation'.$rid;

        
    }

    public function restoretrash($id){
        $restoretrash =  Designation::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Designation Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Designation could not be Restored');
        }
        return redirect()->route('designation.trash');
    }

    public function statusupdate(Request $request, $id){
        $designation          = Designation::find($id);
        $designation->status  = $request->status;
        $status        = $designation->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
