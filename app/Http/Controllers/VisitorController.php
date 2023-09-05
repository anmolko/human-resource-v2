<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;;

class VisitorController extends Controller
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
        $visitors = Visitor::with('employee')->get();
        $employees = Employee::with('user')->get();
        return view('admin.visitor.index',compact('visitors','employees'));
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
        request()->validate([
            'image' => 'mimes:jpeg,png,jpg',
        ]);

        $data=[
            'employee_id'       =>$request->input('employee_id'),
            'visitor_id'        =>$request->input('visitor_id'),
            'visitor_name'      =>$request->input('visitor_name'),
            'mobile_no'         =>$request->input('mobile_no'),
            'reason'            =>$request->input('reason'),
            'misc'              =>$request->input('misc'),
            'created_by'        =>Auth::user()->id,
        ];

        if( !empty( $request->file('image'))) {
            $image     = $request->file('image');
            $path      = base_path().'/public/images/visitor';
            $name      = uniqid().'_'.$image->getClientOriginalName();
            if($image->move($path,$name)){
                $data['image'] = $name;
            }
        }

     
        $status = Visitor::create($data);
        if($status){
            Session::flash('success','New Visitor Created Successfully');
        }
        else{
            Session::flash('error','New Visitor Creation Failed');
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
        $show     = Visitor::with('employee')->find($id);
        if($show->updated_by == null){
            $date = Carbon::parse($show->created_at)->isoFormat('MMMM Do, YYYY, h:mm:ss a');
        }else{
            $date = Carbon::parse($show->updated_at)->isoFormat('MMMM Do, YYYY, h:mm:ss a');
        }

        return response()->json(['show'=>$show,'date'=>$date]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editvisitor     = Visitor::with('employee')->find($id);
        return response()->json($editvisitor);
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
        request()->validate([
            'image' => 'mimes:jpeg,png,jpg',
        ]);


        $visitor                        = Visitor::find($id);
        $visitor->employee_id           = $request->input('employee_id');
        $visitor->visitor_name          = $request->input('visitor_name');
        $visitor->mobile_no             = $request->input('mobile_no');
        $visitor->reason                = $request->input('reason');
        $visitor->misc                  = $request->input('misc');
        $visitor->updated_by            = Auth::user()->id;

        $oldimage                       = $visitor->image;

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $path         = base_path().'/public/images/visitor';
            $name         = uniqid().'_'.$image->getClientOriginalName();
            if( $image->move( $path,$name )){
                $visitor->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/visitor/'.$oldimage)){
                    @unlink(public_path().'/images/visitor/'.$oldimage);
                }
            }
        }
        $status                         = $visitor->update();
        if($status){
            Session::flash('success','Visitor Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Visitor could not be Updated');
        }
        return redirect()->route('visitor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletevisitor= Visitor::find($id);
        
        $deletevisitor->delete();
        return '#visitor'.$id;
    }

    public function trashindex(){
        $trashed = Visitor::with('employee')->onlyTrashed()->get();
        return view('admin.visitor.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  Visitor::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Visitor Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Visitor could not be Restored');
        }
        return redirect()->route('visitor.trash');
    }

    public function deletetrash($id){
        $trashremoval = Visitor::onlyTrashed()->where('id', $id)->get();
        if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/visitor/'.$trashremoval[0]->image)){
            @unlink(public_path().'/images/visitor/'.$trashremoval[0]->image);
        }
        Visitor::onlyTrashed()->where('id', $id)->forceDelete();
        return '#visitor';
    }

}
