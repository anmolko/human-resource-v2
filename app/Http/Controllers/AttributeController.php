<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttributeCreateRequest;
use App\Http\Requests\AttributeUpdateRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AttributeController extends Controller
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
        $attributes = Attribute::all();
        return view('admin.attribute.index',compact('attributes'));

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
    public function store(AttributeCreateRequest $request)
    {
        $attribute = Attribute::create([
            'name'        =>$request->input('name'),
            'status'      =>$request->input('status'),
            'slug'        =>$request->input('slug'),
            'field_type'  =>$request->input('field_type'),
            'created_by' =>Auth::user()->id,
        ]);
        if($attribute){
            Session::flash('success','Attribute Created Successfully');
        }
        else{
            Session::flash('error','Attribute Creation Failed');
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
        $editattribute     = Attribute::find($id);
      
        return response()->json($editattribute);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeUpdateRequest $request, $id)
    {
        $attribute             = Attribute::find($id);
        $attribute->name       = $request->input('name');
        $attribute->slug        = $request->input('slug');
        $attribute->status     = $request->input('status');
        $attribute->field_type     = $request->input('field_type');
        $attribute->updated_by = Auth::user()->id;
        $status=$attribute->update();
        if($status){
            Session::flash('success','Attribute Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Attribute could not be Updated');
        }
        return redirect()->route('attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteattribute = Attribute::find($id);
        $rid             = $deleteattribute->id;
        $checkSecondary = $deleteattribute->secondaryGroups()->get();
        if ($checkSecondary->count() > 0) {
            return 0;

        }else{

             $deleteattribute->delete();
        }
        return '#attribute'.$rid;
    }


    public function trashindex(){
        $trashed = Attribute::onlyTrashed()->get();
        return view('admin.attribute.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = Attribute::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;
        $checkSecondary    = $trashremoval[0]->secondaryGroups()->get();
        if ($checkSecondary->count() > 0 ) {
        
            return 0;
        } else {
            Attribute::onlyTrashed()->where('id', $id)->forceDelete();

        }
         return  '#attribute'.$rid;

        
    }

    public function restoretrash($id){
        $restoretrash =  Attribute::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Attribute Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Attribute could not be Restored');
        }
        return redirect()->route('attribute.trash');
    }
}
