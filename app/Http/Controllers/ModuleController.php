<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleCreateRequest;
use App\Http\Requests\ModuleUpdateRequest;
use App\Models\Module;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ModuleController extends Controller
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
        $modules = Module::latest()->get();
        return view('admin.module.index', compact('modules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.module.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleCreateRequest $request)
    {
        $module = Module::create([
            'name'       =>$request->input('name'),
            'status'     =>$request->input('status'),
            'key'        =>$request->input('key'),
            'url'        =>$request->input('url'),
            'created_by' =>Auth::user()->id,
        ]);
        // dd($module);
        if($module){
            Session::flash('success','Module Created Successfully');
        }
        else{
            Session::flash('error','Module Creation Failed');
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

        $editmodule = Module::find($id);

        return response()->json($editmodule);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModuleUpdateRequest $request, $id)
    {

        $module             =Module::find($id);
        $module->name       =$request->input('name');
        $module->key        =$request->input('key');
        $module->url        =$request->input('url');
        $module->status     =$request->input('status');
        $module->updated_by =Auth::user()->id;
        // dd($module);

        $status=$module->update();
        if($status){
            Session::flash('success','Module Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Module could not be Updated');
        }
        return redirect()->route('module.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletemodule = Module::find($id);
        $rid             = $deletemodule->id;

        $checkroles    = $deletemodule->roles()->get();
        $checkperissions = $deletemodule->permissions()->get();
        if ($checkroles->count() > 0 || $checkperissions->count() > 0) {
            return 0;

        }else{

             $deletemodule->delete();
        }
        return '#module_'.$rid;

        // if($status){
        //     Session::flash('success','Module moved to Trash Successfully');
        // }
        // else{
        //     Session::flash('error','Something Went Wrong.Could not move to Trash');
        // }
        // return redirect()->route('module.index');
    }

    public function trashindex(){
        $trashed = Module::onlyTrashed()->get();
        return view('admin.module.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $module = Module::onlyTrashed()->where('id', $id)->first();

        $rid             = $module->id;
        $checkroles    = $module->roles()->get();
        $checkperissions = $module->permissions()->get();
        if ($checkroles->count() > 0 || $checkperissions->count() > 0) {

            return 0;
        } else {
            Module::onlyTrashed()->where('id', $id)->forceDelete();

        }
         return  '#module_'.$rid;


        // if($trashremoval){
        //     Session::flash('success','Module Permanentaly Deleted.');
        // }
        // else{
        //     Session::flash('error','Something Went Wrong. Module could not be deleted');
        // }
        // return redirect()->route('module.trash');
    }

    public function restoretrash($id){
        $restoretrash =  Module::withTrashed()->where('id', $id)->restore();

        if($restoretrash){
            Session::flash('success','Moule Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Module could not be Restored');
        }
        return redirect()->route('module.trash');
    }

    public function viewroles($id){
        $rolemodule = Module::find($id);
        $data_arr = [];
        foreach($rolemodule->roles as $role){
            $data_arr[] = ucwords($role->name);
        }
        return response()->json($data_arr);
    }


}
