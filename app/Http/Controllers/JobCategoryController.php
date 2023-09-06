<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class JobCategoryController extends Controller
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
        $categories = JobCategory::latest()->get();
        return view('admin.job_category.index',compact('categories'));

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
        $category = JobCategory::create([
            'name'        =>$request->input('name'),
            'description' =>$request->input('description'),
            'status'      =>$request->input('status'),
            'created_by' =>Auth::user()->id,
        ]);
        if($category){
            Session::flash('success','Job Category Created Successfully');
        }
        else{
            Session::flash('error','Job Category Creation Failed');
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
        $editcategory    = JobCategory::find($id);
        return response()->json($editcategory);
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
        $category               = JobCategory::find($id);
        $category->name         = $request->input('name');
        $category->status       = $request->input('status');
        $category->description  = $request->input('description');
        $category->updated_by   = Auth::user()->id;
        $status                 = $category->update();
        if($status){
            Session::flash('success','Job Category Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Job Category could not be Updated');
        }
        return redirect()->route('job-category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletecategory  = JobCategory::find($id);
        $rid             = $deletecategory->id;
        $deletecategory->delete();
        return '#job_category_'.$rid;
    }

    public function trashindex(){
        $trashed = JobCategory::onlyTrashed()->get();
        return view('admin.job_category.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  JobCategory::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Job Category Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Job Category could not be Restored');
        }
        return redirect()->route('job-category.trash');
    }

    public function deletetrash($id){
        $trashremoval = JobCategory::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        JobCategory::onlyTrashed()->where('id', $id)->forceDelete();
         return  '#job_category'.$rid;
    }
}
