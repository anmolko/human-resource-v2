<?php

namespace App\Http\Controllers;

use App\Models\Counsellor;
use App\Models\OverseasAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;;

class CounsellorController extends Controller
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
        $counsellors = Counsellor::all();
        $agents = OverseasAgent::all();

        return view('admin.counsellor.index',compact('counsellors','agents'));
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
        $counsellor = Counsellor::create([
            'overseas_agent_id'  =>$request->input('overseas_agent_id'),
            'description'        =>$request->input('description'),
            'response'           =>$request->input('response'),
            'response_via'       =>$request->input('response_via'),
            'misc'               =>$request->input('misc'),
            'created_by'         =>Auth::user()->id,
        ]);
        if($counsellor){
            Session::flash('success','Counsellor Created Successfully');
        }
        else{
            Session::flash('error','Counsellor Creation Failed');
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
        $editcounsellor     = Counsellor::with('agent')->find($id);
        return response()->json($editcounsellor);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editcounsellor     = Counsellor::with('agent')->find($id);
        return response()->json($editcounsellor);
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
        $counsellor                         = Counsellor::find($id);
        $counsellor->overseas_agent_id      = $request->input('overseas_agent_id');
        $counsellor->description            = $request->input('description');
        $counsellor->response               = $request->input('response');
        $counsellor->response_via           = $request->input('response_via');
        $counsellor->misc                   = $request->input('misc');
        $counsellor->updated_by             = Auth::user()->id;
        $status                             = $counsellor->update();
        if($status){
            Session::flash('success','Counsellor Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Counsellor could not be Updated');
        }
        return redirect()->route('counsellor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletecounsellor = Counsellor::find($id);
        $rid             = $deletecounsellor->id;
       
        $deletecounsellor->delete();

        return '#counsellor'.$rid;
    }


    public function trashindex(){
        $trashed = Counsellor::onlyTrashed()->get();
        return view('admin.counsellor.trash', compact('trashed'));
    }

    public function deletetrash($id){
        $trashremoval = Counsellor::onlyTrashed()->where('id', $id)->get();
        $rid             = $trashremoval[0]->id;
        Counsellor::onlyTrashed()->where('id', $id)->forceDelete();

         return  '#counsellor'.$rid;

        
    }

    public function restoretrash($id){
        $restoretrash =  Counsellor::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Counsellor Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Counsellor could not be Restored');
        }
        return redirect()->route('counsellor.trash');
    }

}
