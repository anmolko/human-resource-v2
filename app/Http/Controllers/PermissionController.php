<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
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
        $permissions = Permission::all();
        $modulevalue       = Module::select('id','name')->get();
        // $modulevalue     = [];
        // $modulevalue[''] ='Select Module';

        // foreach ($modules  as $module){
        //     $modulevalue[$module->id]=ucwords($module->name);
        // }
        return view('admin.permission.index',compact('permissions','modulevalue'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules       = Module::select('id','name')->get();
        $modulevalue     = [];
        $modulevalue[''] ='Select Module';

        foreach ($modules  as $module){
            $modulevalue[$module->id]=ucwords($module->name);
        }
        return view('permission.create',compact('modulevalue'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        $permission = Permission::create([
            'module_id' =>$request->input('module_id'),
            'name' =>$request->input('name'),
            'status' =>$request->input('status'),
            'key' =>$request->input('key'),
            'created_by' =>Auth::user()->id,
        ]);
        if($permission){
            Session::flash('success','Permission Created Successfully');
        }
        else{
            Session::flash('error','Permission Creation Failed');
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
        $editpermission      = Permission::find($id);
        $module_value         = Module::select('id','name')->get();
        // $modulevalue     = [];
        // $modulevalue[''] ='Select Module';
        // foreach ($modules  as $module){
        //     $modulevalue[$module->id]=$module->name;
        // }
        return response()->json(['editpermission'=>$editpermission,'module_value'=>$module_value]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $permission             = Permission::find($id);
        $permission->module_id  = $request->input('module_id');
        $permission->name       = $request->input('name');
        $permission->key        = $request->input('key');
        $permission->status     = $request->input('status');
        $permission->updated_by = Auth::user()->id;
        $status=$permission->update();

        if($status){
            Session::flash('success','Permission Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Permission could not be Updated');
        }
        return redirect()->route('permission.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletepermission = Permission::find($id);
        $rid             = $deletepermission->id;
        $checkroles = $deletepermission->roles()->get();
        if ($checkroles->count() > 0) {
            return 0;

        }else{

             $deletepermission->delete();
        }
        return '#permission_'.$rid;

        // if($status){
        //     Session::flash('success','Permission moved to Trash Successfully');
        // }
        // else{
        //     Session::flash('error','Something Went Wrong. Could not move to Trash');
        // }
        // return redirect()->route('permission.index');
    }

    public function trashindex(){
        $trashed = Permission::onlyTrashed()->get();
        return view('admin.permission.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = Permission::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;
        $checkroles    = $trashremoval[0]->roles()->get();
        if ($checkroles->count() > 0 ) {
        
            return 0;
        } else {
            Permission::onlyTrashed()->where('id', $id)->forceDelete();

        }
         return  '#permission_'.$rid;

        // if($trashremoval){
        //     Session::flash('success','Permission Permanentaly Deleted.');
        // }
        // else{
        //     Session::flash('error','Something Went Wrong. Permission could not be deleted');
        // }
        // return redirect()->route('permission.trash');
    }

    public function restoretrash($id){
        $restoretrash =  Permission::withTrashed()->where('id', $id)->restore();

        if($restoretrash){
            Session::flash('success','Permission Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Permission could not be Restored');
        }
        return redirect()->route('permission.trash');
    }


    public function viewroles($id){
        $permissionmodule = Permission::find($id);
        $data_arr = [];
        foreach($permissionmodule->roles as $role){
            $data_arr[] = ucwords($role->name);
        }
        return response()->json($data_arr);
    }
 
}
