<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BranchOffice;
use App\Models\ReferenceInformation;
use App\Models\SecondaryGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Intervention\Image\ImageManagerStatic as Image;
use CountryState;

class ReferenceInformationController extends Controller
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
        $reference_info = ReferenceInformation::latest()->get();
        $branchoffices = BranchOffice::latest()->get();
        $countries   = CountryState::getCountries();

        return view('admin.reference_informations.index',compact('branchoffices','reference_info','countries'));

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
        $data=[
            'reference_name'        => $request->input('reference_name'),
            'optional_name'         => $request->input('optional_name'),
            'branch_office_id'         => $request->input('branch_office_id'),
            'company'               => $request->input('company'),
            'country'               => $request->input('country'),
            'address'               => $request->input('address'),
            'contact_no'            => $request->input('contact_no'),
            'mobile_no'             => $request->input('mobile_no'),
            'email_address'         => $request->input('email_address'),
            'name_of_organization'  => $request->input('name_of_organization'),
            'membership_no'         => $request->input('membership_no'),
            'status'                => $request->input('status'),
            'created_by'            =>Auth::user()->id,
        ];


        if(!empty($request->file('image'))) {
            $image        = $request->file('image');
            $name1        = uniqid() . '_' . $image->getClientOriginalName();
            $path         = base_path() . '/public/images/referenceinfo/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path, 80)) {
                $data['image'] = $name1;
            }
        }
        $reference = ReferenceInformation::create($data);

        if($reference){
            $slug = str_replace(" ","_",strtolower($request->input('reference_name')));
            $secondarygroup = SecondaryGroup::create([
                'primary_group_id' =>9,
                'name'        =>$request->input('reference_name'),
                'imported_from' => 'true',
                'status'      =>1,
                'slug'        =>$slug,
                'created_by'  => Auth::user()->id,
            ]);

            if($secondarygroup){
                Session::flash('success','Reference Entry Created Successfully');
                return redirect()->back();
            }else{
                Session::flash('error','Secondary Group not created.');
                return redirect()->back();
            }


        }
        else{
            Session::flash('error','Reference Entry Creation Failed');
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
        $reference   = ReferenceInformation::find($id);

        return view('admin.reference_informations.single',compact('reference'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editreference   = ReferenceInformation::with('branchOffice')->find($id);
        $countries = CountryState::getCountries();

        return response()->json(['editreference'=>$editreference,'countries'=>$countries]);
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
        $reference                         =  ReferenceInformation::find($id);
        $old_reference_name                 = $reference->reference_name;

        $reference->reference_name         =  $request->input('reference_name');
        $reference->optional_name          =  $request->input('optional_name');
        $reference->branch_office_id          =  $request->input('branch_office_id');
        $reference->company                =  $request->input('company');
        $reference->country                =  $request->input('country');
        $reference->address                =  $request->input('address');
        $reference->contact_no             =  $request->input('contact_no');
        $reference->mobile_no              =  $request->input('mobile_no');
        $reference->email_address          =  $request->input('email_address');
        $reference->name_of_organization   =  $request->input('name_of_organization');
        $reference->membership_no          =  $request->input('membership_no');
        $reference->status                 =  $request->input('status');
        $reference->updated_by             = Auth::user()->id;

        $oldimage                          = $reference->image;

        if (!empty($request->file('image'))){
            $image =$request->file('image');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/referenceinfo/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(500, 500, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $reference->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/referenceinfo/'.$oldimage)){
                    @unlink(public_path().'/images/referenceinfo/'.$oldimage);
                }
            }
        }

        $status = $reference->update();
        if($status){

            $oldslug           = str_replace(" ","_",strtolower($old_reference_name));
            $secondarygroup     = SecondaryGroup::where("slug",$oldslug)->first();
            $slug = str_replace(" ","_",strtolower($request->input('reference_name')));

            $secondarygroup->name        = $request->input('reference_name');
            $secondarygroup->slug        = $slug;
            $secondarygroup->updated_by  = Auth::user()->id;
            $secondarygroup->update();


            Session::flash('success','Reference Entry Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Reference Entry could not be Updated');
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
        $deletereference  = ReferenceInformation::find($id);
        $rid             = $deletereference->id;

        // $checkjob    = $deletecategory->modules()->get();
        // if ($checkjob->count() > 0 ) {
        //     return 0;

        // }else{

             $deletereference->delete();
        // }
        return '#reference_'.$rid;
    }

    public function trashindex(){
        $trashed = ReferenceInformation::onlyTrashed()->get();
        return view('admin.reference_informations.trash', compact('trashed'));
    }


    public function restoretrash($id){
        $restoretrash =  ReferenceInformation::withTrashed()->where('id', $id)->restore();
        if($restoretrash){
            Session::flash('success','Reference Entry Restored');
        }
        else{
            Session::flash('error','Something Went Wrong. Reference Entry could not be Restored');
        }
        return redirect()->route('reference-info.trash');
    }

    public function deletetrash($id){
        $trashremoval = ReferenceInformation::onlyTrashed()->where('id', $id)->get();

        $rid             = $trashremoval[0]->id;

        // $checkjob    = $trashremoval[0]->secondaryGroups()->get();
        // if ($checkjob->count() > 0 ) {

        //     return 0;
        // } else {
            if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/referenceinfo/'.$trashremoval[0]->image)){
                @unlink(public_path().'/images/referenceinfo/'.$trashremoval[0]->image);
            }
            ReferenceInformation::onlyTrashed()->where('id', $id)->forceDelete();

        // }
         return  '#reference_'.$rid;


    }
}
