<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Models\Role;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
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
        $roles = Role::all();
        return view('admin.role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.role.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        $role = Role::create([
            'name'       => strtolower($request->input('name')),
            'status'     => $request->input('status'),
            'created_by' => Auth::user()->id,
        ]);

        if($role){
            Session::flash('success','Role Created Successfully');
        }
        else{
            Session::flash('error','Role Creation Failed');
        }

        return redirect()->back();
        //this is route method of redirect. another one is by URL 
        //eg: return redirect('/name-of-url');

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
        $editrole = Role::find($id);
        return response()->json($editrole);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name       = strtolower($request->input('name'));
        $role->status     = $request->input('status');
        $role->updated_by = Auth::user()->id;
        $status           = $role->update();

        if($status){
            Session::flash('success','Role Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Role could not be Updated');
        }
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $deleterole = Role::find($id);
        $rid             = $deleterole->id;

        $checkmodules    = $deleterole->modules()->get();
        $checkperissions = $deleterole->permissions()->get();
        if ($checkmodules->count() > 0 || $checkperissions->count() > 0) {
            return 0;

        }else{

             $deleterole->delete();
        }
        return '#role_'.$rid;

//        if($status){
//            Session::flash('success','Role moved to Trash Successfully');
//        }
//        else{
//            Session::flash('error','Something Went Wrong.Could not move to Trash');
//        }
//        return redirect()->route('role.index');
    }

    public function trashindex(){
        $trashed = Role::onlyTrashed()->get();
        return view('admin.role.trash', compact('trashed'));
    }

    public function deletetrash($id){
        
        $role            = Role::onlyTrashed()->where('id', $id)->get();
        $rid             = $role[0]->id;
        $checkmodules    = $role[0]->modules()->get();
        $checkperissions = $role[0]->permissions()->get();
        if ($checkmodules->count() > 0 || $checkperissions->count() > 0) {
        
            return 0;
        } else {
            Role::onlyTrashed()->where('id', $id)->forceDelete();

        }
         return  '#role_'.$rid;
        // if($trashremoval){
        //     Session::flash('success','Role Permanentaly Deleted.');
        // }
        // else{
        //     Session::flash('error','Something Went Wrong. Role could not be deleted');
        // }
        // return redirect()->route('role.trash');
    }

    public function restoretrash($id){
        $restoretrash =  Role::withTrashed()->where('id', $id)->restore();

        if($restoretrash){
            Session::flash('success','Role Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Role could not be Restored');
        }
        return redirect()->route('role.trash');
    }

    public function assignmodules($id){
        $role = Role::find($id);
        $modules = Module::select('id','name','key')->get();
        $selected = [];
        foreach ($role->modules as $rm){
            array_push($selected,$rm->id);
        }

        $module_permissions     = $role->modules;
        $permissions = Permission::select('id','name','key')->get();

        $selected_permissions    = [];
        foreach ($role->permissions as $permission){
            array_push($selected_permissions,$permission->id);
        }

        return view('admin.role.module_assign',compact('role','modules','selected','permissions','selected_permissions','module_permissions'));
    }

    public function viewmodules($id){
        $role = Role::find($id);
        return view('admin.role.viewmodulerole',compact('role'));
    }

    public function storemodules(Request $request, $id){
        $role = Role::with('modules')->find($id);
        $roleid= $id;

        $old_module     = $role->modules;
        // dd($role);
        $db_elements     = json_decode($old_module,true);
        $db_elements_id  = array_map(function($item){ return $item['id']; }, $db_elements);

        $status = $role->modules()->sync($request->input('module_id'));
        $role = Role::find($id);
        $module_permissions     = $role->modules;
        $db_elements2     = json_decode($module_permissions,true);
        $db_elements_id2  = array_map(function($item){ return $item['id']; }, $db_elements2);
        $main_remove_permission_data=[];
        $permission_remove=[];
        foreach($old_module as $old){
            if(!in_array($old->id,$db_elements_id2)){
                $moduleid=$old->id;
                $main_remove_permission_data[] = Permission::with('module')
                                        ->where('module_id', $moduleid)
                                        ->get();

            }
        }   

        foreach($main_remove_permission_data as $remove_permission_data){
            foreach($remove_permission_data as $remove){
                $permission_remove[] = $remove->id;
            }
        }
        foreach($permission_remove as $rem){
            $role->permissions()->detach($rem);

        }

        if ($status){
            Session::flash('success','Module(s) Assigned successfully');
        }else{
            Session::flash('success','Something Went Wrong.Module(s) could not be Assigned');
        }
        return redirect()->route('role.index');
    }


    public function assignpermission($id){
        $role        = Role::find($id);
        $modules     = $role->modules;
        $permissions = Permission::select('id','name')->get();

        $selected    = [];
        foreach ($role->permissions as $permission){
            array_push($selected,$permission->id);
        }
        return view('admin.role.permissionrole',compact('role','permissions','selected','modules'));
    }

    public function storepermissions(Request $request, $id){
        $role = Role::find($id);
        $status =  $role->permissions()->sync($request->input('permission_id'));
        if ($status){
            Session::flash('success','Permission Saved successfully');
        }else{
            Session::flash('success','Permission Addition Unsuccessfully');
        }
        return redirect()->route('role.index');
    }
}
