<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanySettingCreateRequest;
use App\Http\Requests\CompanySettingUpdateRequest;
use App\Models\CompanySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class CompanySettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $companySetting = null;

    public function __construct(CompanySetting $companySetting)
    {
        $this->middleware('auth');
        $this->companySetting = $companySetting;
    }



    public function index()
    {
        $company_settings = CompanySetting::first();
        return view('admin.setting.company_setting',compact('company_settings'));

    }

    public function appindex()
    {
        $company_settings = CompanySetting::first();
        return view('admin.setting.application_setting',compact('company_settings'));

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
    public function store(CompanySettingCreateRequest $request)
    {

        $data=[
            'company_name'          =>$request->input('company_name'),
            'slug'                  =>$request->input('slug'),
            'company_address'       =>$request->input('company_address'),
            'company_license'       =>$request->input('company_license'),
            'email'                 =>$request->input('email'),
            'phone'                 =>$request->input('phone'),
            'mobile'                =>$request->input('mobile'),
            'pan_number'            =>$request->input('pan_number'),
            'from'                  =>$request->input('from'),
            'to'                    =>$request->input('to'),
            'created_by'            =>Auth::user()->id,
        ];

        if(!empty($request->file('company_logo'))){
            $image = $request->file('company_logo');
            $name= uniqid().'_'.$image->getClientOriginalName();
            $path=base_path().'/public/images/company/'.$name;
            $image_resize = Image::make($image->getRealPath())->orientate();
//            $image_resize->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio(); //maintain image ratio
//            });
            if($image_resize->save($path,80)){
                $data['company_logo']=$name;
            }
        }

        if(!empty($request->file('letterhead'))){
            $image = $request->file('letterhead');
            $name= uniqid().'_letterhead_'.$image->getClientOriginalName();
            $path=base_path().'/public/images/company/'.$name;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if($image_resize->save($path,80)){
                $data['letterhead']=$name;
            }
        }

        $company = CompanySetting::create($data);

        if($company){
            Session::flash('success','Company Settings Created Successfully');
        }
        else{
            Session::flash('error','Company Settings Creation Failed');
        }
        return redirect()->back();
    }


    public function appstore(Request $request){

        $this->companySetting = CompanySetting::find($request->input('company_id'));
        if(!$this->companySetting) {
            Session::flash('error','Data not found');
            return redirect()->back();
        }

        $companysetting                            = CompanySetting::find($request->input('company_id'));
        $companysetting->application_selected      = $request->input('radio');
        $companysetting->updated_by                = Auth::user()->id;
        $status                                    = $companysetting->update();
        if($status){
            Session::flash('success','Candidate application Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Candidate application could not be Updated');
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
    public function update(CompanySettingUpdateRequest $request, $id)
    {

        $this->companySetting = $this->companySetting->find($id);
        if(!$this->companySetting) {
            Session::flash('error','Data not found');
            return redirect()->back();
        }

        $companysetting                       = CompanySetting::find($id);
        $companysetting->company_name         = $request->input('company_name');
        $companysetting->company_address      = $request->input('company_address');
        $companysetting->company_license      = $request->input('company_license');
        $companysetting->slug                 = $request->input('slug');
        $companysetting->email                = $request->input('email');
        $companysetting->phone                = $request->input('phone');
        $companysetting->pan_number           = $request->input('pan_number');
        $companysetting->from                 = $request->input('from');
        $companysetting->to                   = $request->input('to');
        $companysetting->mobile               = $request->input('mobile');
        $companysetting->updated_by           = Auth::user()->id;
        $oldimage                             = $companysetting->company_logo;
        $letterhead                           = $companysetting->letterhead;
        $extra                                = $companysetting->extra_header;

        if (!empty($request->file('company_logo'))){
            $image =$request->file('company_logo');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/company/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
//            $image_resize->resize(100, 100, function ($constraint) {
//                $constraint->aspectRatio(); //maintain image ratio
//            });
            if ($image_resize->save($path,80)){
                $companysetting->company_logo= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/company/'.$oldimage)){
                    @unlink(public_path().'/images/company/'.$oldimage);
                }
            }

        }

        if (!empty($request->file('letterhead'))){
            $image        = $request->file('letterhead');
            $name         = uniqid().'_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/company/'.$name;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path,80)){
                $companysetting->letterhead= $name;
                if (!empty($letterhead) && file_exists(public_path().'/images/company/'.$letterhead)){
                    @unlink(public_path().'/images/company/'.$letterhead);
                }
            }
        }

        if (!empty($request->file('extra_header'))){
            $image        = $request->file('extra_header');
            $name         = uniqid().'_extra_'.$image->getClientOriginalName();
            $path         = base_path().'/public/images/company/'.$name;
            $image_resize = Image::make($image->getRealPath())->orientate();
            if ($image_resize->save($path,80)){
                $companysetting->extra_header= $name;
                if (!empty($extra) && file_exists(public_path().'/images/company/'.$extra)){
                    @unlink(public_path().'/images/company/'.$extra);
                }
            }
        }

        $status=$companysetting->update();
        if($status){
            Session::flash('success','Company Settings Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Company Settings could not be Updated');
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
