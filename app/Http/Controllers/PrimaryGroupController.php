<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrimaryGroupCreateRequest;
use App\Http\Requests\PrimaryGroupUpdateRequest;
use App\Models\PrimaryGroup;
use App\Models\Attribute;
use App\Models\SecondaryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PrimaryGroupController extends Controller
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
        $primary_groups = PrimaryGroup::latest()->get();
        $all_attributes       = Attribute::latest()->get();

        return view('admin.primary_group.index',compact('primary_groups','all_attributes'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrimaryGroupCreateRequest $request)
    {

        if($request->input('classfication')=="capital account"){
            $nature = "liabilities";
        }else if($request->input('classfication')=="current liabilities"){
            $nature = "liabilities";
        }else if($request->input('classfication')=="non current liabilities"){
            $nature = "liabilities";
        }else if($request->input('classfication')=="non current assets"){
            $nature = "assets";
        }else if($request->input('classfication')=="current assets"){
            $nature = "assets";
        }else if($request->input('classfication')=="fixed assets"){
            $nature = "assets";
        }else if($request->input('classfication')=="investment"){
            $nature = "assets";
        }else{
            $nature = "profit & loss a/c";
        }

        $primarygroup = PrimaryGroup::create([
            'name'           =>$request->input('name'),
            'classfication'  =>$request->input('classfication'),
            'nature'         => $nature,
            'status'         =>$request->input('status'),
            'slug'           =>$request->input('slug'),
            'created_by'     =>Auth::user()->id,
        ]);
        $primary = PrimaryGroup::find($primarygroup->id);
        $status =  $primary->attributes()->sync($request->input('attribute_id'));
        if($primarygroup && $status){
            Session::flash('success','Primary Group Created Successfully');
        }
        else{
            Session::flash('error','Primary Group Creation Failed');
        }
        return redirect()->back();
    }

      /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editprimarygroup     = PrimaryGroup::find($id);
        $all_attributes       = Attribute::latest()->get();
        $selected    = [];
        foreach ($editprimarygroup->attributes as $attribute){
            array_push($selected,['id'=>$attribute->id]);
        }
        return response()->json(['editprimarygroup'=>$editprimarygroup,'selected'=>$selected,'all_attributes'=>$all_attributes]);
        // return response()->json($editprimarygroup);
    }


     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrimaryGroupUpdateRequest $request, $id)
    {

        if($request->input('classfication')=="capital account"){
            $nature = "liabilities";
        }else if($request->input('classfication')=="current liabilities"){
            $nature = "liabilities";
        }else if($request->input('classfication')=="non current liabilities"){
            $nature = "liabilities";
        }else if($request->input('classfication')=="non current assets"){
            $nature = "assets";
        }else if($request->input('classfication')=="current assets"){
            $nature = "assets";
        }else if($request->input('classfication')=="fixed assets"){
            $nature = "assets";
        }else if($request->input('classfication')=="investment"){
            $nature = "assets";
        }else{
            $nature = "profit & loss a/c";
        }


        $primarygroup                   = PrimaryGroup::find($id);
        $primarygroup->name             = $request->input('name');
        $primarygroup->classfication    = $request->input('classfication');
        $primarygroup->nature           = $nature;
        $primarygroup->slug             = $request->input('slug');
        $primarygroup->status           = $request->input('status');
        $primarygroup->updated_by       = Auth::user()->id;
        $status=$primarygroup->update();
        $manystatus =  $primarygroup->attributes()->sync($request->input('attribute_id'));
        if($status && $manystatus){
            Session::flash('success','Primary Group Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Primary Group could not be Updated');
        }
        return redirect()->route('primary-groups.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleteprimarygroup = PrimaryGroup::find($id);
        $rid             = $deleteprimarygroup->id;
        $checksecondary = $deleteprimarygroup->secondaryGroups()->get();
        if ($checksecondary->count() > 0) {
            return 0;

        }else{

             $deleteprimarygroup->delete();
        }
        return '#primarygroup'.$rid;
    }

    public function trashindex(){
      $trashed = PrimaryGroup::onlyTrashed()->get();
      return view('admin.primary_group.trash', compact('trashed'));
     }

    public function deletetrash($id){
      $trashremoval = PrimaryGroup::onlyTrashed()->where('id', $id)->get();

      $rid             = $trashremoval[0]->id;
      $checksecondary = $trashremoval[0]->secondaryGroups()->get();
        if ($checksecondary->count() > 0) {

          return 0;
      } else {
        $checkdelete    = $trashremoval[0]->attributes()->detach();
        if ($checkdelete) {
          PrimaryGroup::onlyTrashed()->where('id', $id)->forceDelete();
        }
      }
       return  '#primarygroup'.$rid;

  }

    public function restoretrash($id){
      $restoretrash =  PrimaryGroup::withTrashed()->where('id', $id)->restore();
      if($restoretrash){
          Session::flash('success','Primary Group Restored');
      }
      else{
          Session::flash('error','Something Went Wrong. Primary Group could not be Restored');
      }
      return redirect()->route('primary-groups.trash');
  }


  public function viewsecondary($id){
    $primary_secondary = PrimaryGroup::find($id);
    $data_arr = [];
    foreach($primary_secondary->secondaryGroups as $secondary){
        $data_arr[] = ucwords($secondary->name);
    }
    return response()->json($data_arr);
}


}
