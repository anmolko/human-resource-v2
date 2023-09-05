<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;


class FolderController extends Controller
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
        $folders = Folder::with('candidate')->get();
        return view('admin.file_management.folder_list',compact('folders'));

    }

    public function file($id)
    {
        $folder = Folder::with('candidate')->find($id);
        $files = File::where('folder_id', $id)->with('folder')->get();

        return view('admin.file_management.file_list',compact('folder','files'));

    }

    public function download($file_name) {

        $file = File::where('filename', $file_name)->with('folder')->first();
        if($file->type=="bank"){
            $file_path = public_path('images/bank/' . $file_name);

        }elseif($file->type=="license"){
            $file_path = public_path('images/license/' . $file_name);

        }elseif($file->type=="document"){
            $file_path = public_path('images/document/' . $file_name);

        }
        return response()->download($file_path);
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
        $file_data=[
            'type'              => $request->input('type'),
            'folder_id'         => $request->input('folder_id'),
            'status'         => '1',
            'created_by'        =>Auth::user()->id,
        ];

        if(!empty($request->file('filename'))) {
            $image = $request->file('filename');

            if($request->input('type')=="bank"){
                $name1 = 'bank_'.uniqid() . '_' . $image->getClientOriginalName();
                $path = base_path() . '/public/images/bank/';
            }elseif($request->input('type')=="license"){
                $name1 = 'license_'.uniqid() . '_' . $image->getClientOriginalName();
                $path = base_path() . '/public/images/license/' ;
            }elseif($request->input('type')=="document"){
                $name1 = 'document_'.uniqid() . '_' . $image->getClientOriginalName();
                $path = base_path() . '/public/images/document/';
            }
            if($image->move($path,$name1)){
                $file_data['filename'] = $name1;
            }
        }


        $file_info = File::create($file_data);


        if ($file_info) {
            Session::flash('success', 'File Uploded Successfully');
        } else {
            Session::flash('error', 'File Uploading Failed');
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
        $file      = File::find($id);
        
        return response()->json($file);
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
        $file_info                =  File::find($id);
        $oldfilename              = $file_info->filename;
        $oldtype                  = $file_info->type;

        $file_info->type          =  $request->input('type');



        if(!empty($request->file('filename'))){
            $file       = $request->file('filename');

            if($request->input('type')=="bank"){
                $name = 'bank_'.uniqid() . '_' . $file->getClientOriginalName();
                $path = base_path() . '/public/images/bank/';
            }elseif($request->input('type')=="license"){
                $name = 'license_'.uniqid() . '_' . $file->getClientOriginalName();
                $path = base_path() . '/public/images/license/' ;
            }elseif($request->input('type')=="document"){
                $name = 'document_'.uniqid() . '_' . $file->getClientOriginalName();
                $path = base_path() . '/public/images/document/';
            }

            if($file->move($path,$name)){
                $file_info->filename = $name;

                if($oldtype=="bank"){
                    if (!empty($oldfilename) && file_exists(public_path().'/images/bank/'.$oldfilename)){
                        @unlink(public_path().'/images/bank/'.$oldfilename);
                    }
                }elseif($oldtype=="license"){
                    if (!empty($oldfilename) && file_exists(public_path().'/images/license/'.$oldfilename)){
                        @unlink(public_path().'/images/license/'.$oldfilename);
                    }
                }elseif($oldtype=="document"){
                    if (!empty($oldfilename) && file_exists(public_path().'/images/document/'.$oldfilename)){
                        @unlink(public_path().'/images/document/'.$oldfilename);
                    }
                }

            }
        }

        $filestatus = $file_info->update();

        if($filestatus){
            Session::flash('success','File Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. File could not be Updated');
        }
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file           = File::find($id);
        if($file->type=="bank"){
            if (!empty($file->filename) && file_exists(public_path().'/images/bank/'.$file->filename)){
                @unlink(public_path().'/images/bank/'.$file->filename);
            }
        }elseif($file->type=="license"){
            if (!empty($file->filename) && file_exists(public_path().'/images/license/'.$file->filename)){
                @unlink(public_path().'/images/license/'.$file->filename);
            }
        }elseif($file->type=="document"){
            if (!empty($file->filename) && file_exists(public_path().'/images/document/'.$file->filename)){
                @unlink(public_path().'/images/document/'.$file->filename);
            }
        }

            
        $trash_status    = $file->delete();
        return  '#file_'.$id;

    }
}
