<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentCreateRequest;
use App\Http\Requests\DepartmentUpdateRequest;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
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
        $departments = Department::latest()->get();
        return view('admin.department.index',compact('departments'));
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
    public function store(DepartmentCreateRequest $request)
    {
        $department = Department::create([
            'name'        =>$request->input('name'),
            'description' =>$request->input('description'),
            'status'      =>$request->input('status'),
            'created_by' =>Auth::user()->id,
        ]);
        if($department){
            Session::flash('success','Department Created Successfully');
        }
        else{
            Session::flash('error','Department Creation Failed');
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
        $editdepartment    = Department::find($id);
        return response()->json($editdepartment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentUpdateRequest $request, $id)
    {
        $department               = Department::find($id);
        $department->name         = $request->input('name');
        $department->status       = $request->input('status');
        $department->description  = $request->input('description');
        $department->updated_by   = Auth::user()->id;
        $status                 = $department->update();
        if($status){
            Session::flash('success','Department Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Department could not be Updated');
        }
        return redirect()->route('department.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletedepartment = Department::find($id);
        $rid             = $deletedepartment->id;
        $checkDesignation = $deletedepartment->designation()->get();
        if ($checkDesignation->count() > 0) {
            return 0;

        }else{

             $deletedepartment->delete();
        }
        return '#department'.$rid;
    }

    public function trashindex(){
        $trashed = Department::onlyTrashed()->get();
        return view('admin.department.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = Department::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;
        $checkDesignation    = $trashremoval[0]->designation()->get();
        if ($checkDesignation->count() > 0 ) {

            return 0;
        } else {
            Department::onlyTrashed()->where('id', $id)->forceDelete();

        }
         return  '#department'.$rid;


    }

    public function restoretrash($id){
        $restoretrash =  Department::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Department Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Department could not be Restored');
        }
        return redirect()->route('department.trash');
    }

    public function statusupdate(Request $request, $id){
        $department          = Department::find($id);
        $department->status  = $request->status;
        $status        = $department->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }
}
