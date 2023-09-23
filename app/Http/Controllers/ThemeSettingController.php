<?php

namespace App\Http\Controllers;

use App\Http\Requests\ThemeSettingCreateRequest;
use App\Http\Requests\ThemeSettingUpdateRequest;
use App\Models\ThemeSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class ThemeSettingController extends Controller
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
        $theme_settings = ThemeSetting::first();
        return view('admin.setting.theme_setting',compact('theme_settings'));

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
    public function store(ThemeSettingCreateRequest $request)
    {
        $data=[
            'website_name'              =>$request->input('website_name'),
            'color'                     =>$request->input('color'),
            'currency'                  =>$request->input('currency'),
            'default_date_format'       =>$request->input('default_date_format'),
            'created_by'                =>Auth::user()->id,
        ];

        if(!empty($request->file('logo'))){
            $image = $request->file('logo');
            $name= uniqid().'_'.$image->getClientOriginalName();
            $path=base_path().'/public/images/theme/'.$name;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if($image_resize->save($path,80)){
                $data['logo']=$name;
            }
        }

        if(!empty($request->file('favicon'))){
            $image = $request->file('favicon');
            $name= uniqid().'_'.$image->getClientOriginalName();
            $path=base_path().'/public/images/theme/'.$name;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(32, 32, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if($image_resize->save($path,80)){
                $data['favicon']=$name;
            }
        }
        $theme = ThemeSetting::create($data);

        if($theme){
            Session::flash('success','Theme Settings Created Successfully');
        }
        else{
            Session::flash('error','Theme Settings Creation Failed');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeSettingUpdateRequest $request, $id)
    {
        $update_theme = ThemeSetting::find($id);
        $update_theme->website_name             =  $request->input('website_name');
        $update_theme->color                    =  $request->input('color');
        $update_theme->currency                 =  $request->input('currency');
        $update_theme->default_date_format      =  $request->input('default_date_format');
        $update_theme->updated_by       =  Auth::user()->id;

        $oldimage_logo= $update_theme->logo;
        $oldimage_favicon= $update_theme->favicon;

        if (!empty($request->file('logo'))){
            $path = base_path().'/public/images/theme';
            $image =$request->file('logo');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            if ($image->move($path,$name1)){
                $update_theme->logo= $name1;
                if (!empty($oldimage_logo) && file_exists(public_path().'/images/theme/'.$oldimage_logo)){
                    @unlink(public_path().'/images/theme/'.$oldimage_logo);
                }
            }

        }

        if (!empty($request->file('favicon'))){
            $path = base_path().'/public/images/theme';
            $image =$request->file('favicon');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            if ($image->move($path,$name1)){
                $update_theme->favicon= $name1;
                if (!empty($oldimage_favicon) && file_exists(public_path().'/images/theme/'.$oldimage_favicon)){
                    @unlink(public_path().'/images/theme/'.$oldimage_favicon);
                }
            }

        }

        $status=$update_theme->update();


        if($status){
            Session::flash('success','Theme Settings Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Theme Settings could not be Updated');
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
        //
    }
}
