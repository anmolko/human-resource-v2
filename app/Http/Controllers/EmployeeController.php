<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Designation;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Role;
use App\Models\SecondaryGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\ImageManagerStatic as Image;

class EmployeeController extends Controller
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
        $employees  = Employee::with('user')->get();
        return view('admin.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $all_roles = Role::latest()->get();
        $departments = Department::where('status','1')->get();

        return view('admin.employee.create',compact('all_roles','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        $data=[
            'name'              =>$request->input('name'),
            'email'             =>$request->input('email'),
            'dob'               =>$request->input('dob'),
            'gender'            =>$request->input('gender'),
            'address'           =>$request->input('address'),
            'contact'           =>$request->input('contact'),
            'user_type'           =>'employee',
            'password'          =>bcrypt($request->input('password')),
        ];

        if(!empty($request->file('image'))) {
            $image = $request->file('image');
            $name1 = uniqid() . '_' . $image->getClientOriginalName();
            $path = base_path() . '/public/images/user/' . $name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path, 80)) {
                $data['image'] = $name1;
            }
        }

        $status = User::create($data);

        if($status){
            $status->roles()->attach($request->input('role_id'));
                    $employee_data=[
                        'user_id'           =>$status->id,
                        'father_name'       =>$request->input('father_name'),
                        'mother_name'       =>$request->input('mother_name'),
                        'contact_no'        =>$request->input('contact_no'),
                        'emergency_contact' =>$request->input('emergency_contact'),
                        'marital_status'    =>$request->input('marital_status'),
                        'department_id'     =>$request->input('department_id'),
                        'designation_id'    =>$request->input('designation_id'),
                        'job_status'        =>$request->input('job_status'),
                        'created_by'        =>Auth::user()->id,
                    ];



                    if( !empty( $request->file('cv'))) {
                        $cv = $request->file('cv');
                        $path      = base_path().'/public/images/employee/cv';
                        $cvname      = uniqid().'_'.$cv->getClientOriginalName();
                        if($cv->move($path,$cvname)){
                            $employee_data['cv'] = $cvname;
                        }
                    }

                    if( !empty( $request->file('citizenship'))) {
                        $citizenship = $request->file('citizenship');
                        $cpath      = base_path().'/public/images/employee/citizenship';
                        $citizenname      = uniqid().'_'.$citizenship->getClientOriginalName();
                        if($citizenship->move($cpath,$citizenname)){
                            $employee_data['citizenship'] = $citizenname;
                        }
                    }

                    $employee = Employee::create($employee_data);
                    if($employee){
                        $latest   = Employee::with('user')->latest()->limit(1)->first();
                        $fullname = str_replace(" ","_",strtolower($latest->user->name));
                        $slug     = $fullname."_".$latest->user_id;
                        $secondarygroup = SecondaryGroup::create([
                            'primary_group_id' =>4,
                            'name'        =>$latest->user->name,
                            'status'      =>1,
                            'slug'        =>$slug,
                            'created_by'  => Auth::user()->id,
                        ]);
                        if($secondarygroup){
                            Session::flash('success','New Employee Created Successfully');
                            return redirect()->back();
                        }else{
                            Session::flash('error','Secondary Group not created.');
                            return redirect()->back();
                        }
                    }
                    else{
                        Session::flash('error','New Employee Creation Failed');
                        return redirect()->back();

                    }



        }else{
            Session::flash('error','New Employee  Creation Failed');
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

        $editemployee = Employee::with('user','department','designation')->find($id);
        $edituser = User::with('roles')->find($editemployee->user_id);
        $userrole = $edituser->roles->first();
        $dateofjoin = Carbon::parse($edituser->created_at)->isoFormat('MMMM Do, YYYY');
        $dob = Carbon::parse($edituser->dob)->isoFormat('MMMM Do, YYYY');
        $lastlogin = Carbon::parse($edituser->last_login_at)->isoFormat('MMMM Do, YYYY, h:mm:ss a');

        foreach ($edituser->roles as $role){
            $permission_count = $role->permissions->count();
        }

        foreach ($edituser->roles as $roles){
            $modules_count = $roles->modules->count();
        }

        $module_per = array();
        foreach ($userrole->modules as $module){
            $module_per = '<li>
                <div class="title">Module name</div>
                <div class="text">';

        }

        $data_arr = array(
            "editemployee" => $editemployee,
            "edituser"=>$edituser,
            "permissioncount"=>$permission_count,
            "modulecount"=>$modules_count,
            "userrole"=>$userrole,
            "dateofjoin"=>$dateofjoin,
            "dob"=>$dob,
            "last_login"=>$lastlogin,
            "module_per"=>$module_per
        );
        return response()->json($data_arr);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $all_roles = Role::latest()->get();
        $departments = Department::where('status','1')->get();
        $editemployee    = Employee::with('user')->find($id);
        $designations = Designation::where('department_id',$editemployee->department_id)->select('id','name')->get();
        $designationsvalue     = [];
        foreach ($designations  as $designation){
            $designationsvalue[$designation->id]=ucwords($designation->name);
        }
        $edituser = User::with('roles')->find($editemployee->user_id);
        $userrole = $edituser->roles->first();

        return view('admin.employee.edit',compact('all_roles','userrole','departments','editemployee','designationsvalue'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, $id,$userid)
    {
        $user                 =  User::find($userid);
        $user->name           =  $request->input('name');
        $user->email          =  $request->input('email');
        $user->dob            =  $request->input('dob');
        $user->gender         =  $request->input('gender');
        $user->address        =  $request->input('address');
        $user->contact        =  $request->input('contact');

        if($request->input('password') !== null){
            $user->password        =  bcrypt($request->input('password'));
        }
         $user->roles()->sync($request->input('role_id'));
        $oldimage             = $user->image;

        if(!empty($request->file('image'))){
            $image        = $request->file('image');
            $path         = base_path().'/public/images/user';
            $name         = uniqid().'_'.$image->getClientOriginalName();
            if( $image->move( $path,$name )){
                $user->image = $name;
                if (!empty($oldimage) && file_exists(public_path().'/images/user/'.$oldimage)){
                    unlink(public_path().'/images/user/'.$oldimage);
                }
            }
        }

        $userstatus = $user->update();

        $employee                       =  Employee::find($id);
        $employee->father_name          =  $request->input('father_name');
        $employee->mother_name          =  $request->input('mother_name');
        $employee->contact_no           =  $request->input('contact_no');
        $employee->emergency_contact    =  $request->input('emergency_contact');
        $employee->marital_status       =  $request->input('marital_status');
        $employee->department_id        =  $request->input('department_id');
        $employee->designation_id       =  $request->input('designation_id');
        $employee->job_status           =  $request->input('job_status');
        $employee->updated_by           =  Auth::user()->id;

        $oldcv             = $employee->cv;
        $oldcitizenship            = $employee->citizenship;


        if(!empty($request->file('cv'))){
            $cvfile       = $request->file('cv');
            $cvpath         = base_path().'/public/images/employee/cv';
            $cvname         = uniqid().'_'.$cvfile->getClientOriginalName();
            if( $cvfile->move($cvpath,$cvname)){
                $employee->cv = $cvname;
                if (!empty($oldcv) && file_exists(public_path().'/images/employee/cv/'.$oldcv)){
                    unlink(public_path().'/images/employee/cv/'.$oldcv);
                }
            }
        }

         if(!empty($request->file('citizenship'))){
            $citizenshipfile        = $request->file('citizenship');
            $ppath                   = base_path().'/public/images/employee/citizenship';
            $cname                   = uniqid().'_'.$citizenshipfile->getClientOriginalName();
            if( $citizenshipfile->move( $ppath,$cname )){
                $employee->citizenship = $cname;
                if (!empty($oldcitizenship) && file_exists(public_path().'/images/employee/citizenship/'.$oldcitizenship)){
                    unlink(public_path().'/images/employee/citizenship/'.$oldcitizenship);
                }
            }
        }
        $employeestatus = $employee->update();

        if($employeestatus && $userstatus){
            Session::flash('success','Employee Profile Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. Employee Profile could not be Updated');
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
        $deleteemployee      = Employee::find($id);
        $userid             = $deleteemployee->user_id;
        $deleteuser      = User::find($userid);
        $deleteuser->delete();
        $deleteemployee->delete();

        return '#employee_trash'.$userid;
    }

    public function trashindex(){
        $trashed   = Employee::onlyTrashed()->with('userTrash')->get();
        return view('admin.employee.trash', compact('trashed'));
    }

    public function restoretrash($id){
        $restoretrash =  Employee::withTrashed()->find($id);
        $restoretrashuser =  User::withTrashed()->find($restoretrash->user_id);
        $restoretrash->restore();
        $restoretrashuser->restore();
        Session::flash('success','Employee is Restored');
        return redirect()->route('employee.trash');
    }

    public function deletetrash($id){
        $trashremoval = Employee::onlyTrashed()->where('id', $id)->get();

        $trashremovaluser = User::onlyTrashed()->where('id', $trashremoval[0]->user_id)->get();
        if (!empty($trashremovaluser[0]->image) && file_exists(public_path().'/images/user/'.$trashremovaluser[0]->image)){
            @unlink(public_path().'/images/user/'.$trashremovaluser[0]->image);
        }

        User::onlyTrashed()->where('id', $trashremoval[0]->user_id)->forceDelete();

        if (!empty($trashremoval[0]->cv) && file_exists(public_path().'/images/employee/cv/'.$trashremoval[0]->cv)){
            @unlink(public_path().'/images/employee/cv/'.$trashremoval[0]->cv);
        }
        if (!empty($trashremoval[0]->citizenship) && file_exists(public_path().'/images/employee/citizenship/'.$trashremoval[0]->citizenship)){
            @unlink(public_path().'/images/employee/citizenship/'.$trashremoval[0]->citizenship);
        }
        Employee::onlyTrashed()->where('id', $id)->forceDelete();

        return '#employee_management'.$id;

    }

    public function getDesignation(Request $request)
    {
        $department = $request->department;
        $designations = Designation::where('department_id',$department)->select('id','name')->get();
        $designationsvalue     = [];
        foreach ($designations  as $designation){
            $designationsvalue[$designation->id]=ucwords($designation->name);
        }
        return response()->json($designationsvalue);
    }

        /**
     * Return Downloadable File
     */
    public function cvDownload($file_name) {
        $file_path = public_path('images/employee/cv/' . $file_name);
        return response()->download($file_path);
    }


    /**
     * Return Downloadable File
     */
    public function citizenshipDownload($file_name) {
        $file_path = public_path('images/employee/citizenship/' . $file_name);
        return response()->download($file_path);
    }


}
