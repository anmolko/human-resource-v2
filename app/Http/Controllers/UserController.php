<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
//use Intervention\Image\Image;

use Intervention\Image\ImageManagerStatic as Image;

class UserController extends Controller
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
        $all_user = User::with('roles')->where('user_type','general')->orderBy('name','asc')->get();
        $all_roles = Role::latest()->get();
        return view('admin.user_management.index',compact('all_user','all_roles'));
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
            'name'              =>$request->input('name'),
            'email'             =>$request->input('email'),
            'dob'               =>$request->input('dob'),
            'gender'            =>$request->input('gender'),
            'address'           =>$request->input('address'),
            'contact'           =>$request->input('contact'),
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
            Session::flash('success','New User Created Successfully');
            $status->roles()->attach($request->input('role_id'));

        }else{
            Session::flash('error','New User  Creation Failed');
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
        $edituser = User::with('roles')->find($id);
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
        $useredit = User::with('roles')->find($id);
        return response()->json($useredit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileUpdateRequest $request, $id)
    {

        $user                 =  User::find($id);
        $user->name           =  $request->input('name');
        $user->email          =  $request->input('email');
        $user->dob            =  $request->input('dob');
        $user->gender         =  $request->input('gender');
        $user->address        =  $request->input('address');
        $user->contact        =  $request->input('contact');

        if($request->input('user-mgm') !== null && $request->input('password') !== null){
            $user->password        =  bcrypt($request->input('password'));
        }else if($request->input('user-mgm') !== null){
            $user->roles()->sync($request->input('role_id'));
        }
        $oldimage             = $user->image;
        if (!empty($request->file('image'))){
            $image =$request->file('image');
            $name1 = uniqid().'_'.$image->getClientOriginalName();
            $path = base_path().'/public/images/user/'.$name1;
            $image_resize = Image::make($image->getRealPath())->orientate();
            $image_resize->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio(); //maintain image ratio
            });
            if ($image_resize->save($path,80)){
                $user->image= $name1;
                if (!empty($oldimage) && file_exists(public_path().'/images/user/'.$oldimage)){
                    @unlink(public_path().'/images/user/'.$oldimage);
                }
            }
        }

        $status = $user->update();
        if($status){
            Session::flash('success','User Profile Updated Successfully');
        }
        else{
            Session::flash('error','Something Went Wrong. User Profile could not be Updated');
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
        $deleteuser      = User::find($id);
        $rid             = $deleteuser->id;
        $deleteuser->delete();
        return '#user_trash'.$rid;
    }

    public function trashindex(){
        $trashed   = User::onlyTrashed()->with('roles')->orderBy('name','asc')->get();
        $all_roles = Role::latest()->get();
        return view('admin.user_management.trash', compact('trashed','all_roles'));
    }

    public function restoretrash($id){
        $restoretrash =  User::withTrashed()->find($id);
        $restoretrash->restore();
        Session::flash('success','User is Restored');
        return redirect()->route('user.trash');
    }

    public function deletetrash($id){
        $trashremoval = User::onlyTrashed()->where('id', $id)->get();
        if (!empty($trashremoval[0]->image) && file_exists(public_path().'/images/user/'.$trashremoval[0]->image)){
            @unlink(public_path().'/images/user/'.$trashremoval[0]->image);
        }
        User::onlyTrashed()->where('id', $id)->forceDelete();
        return '#user_management';
    }

    public function statusupdate(Request $request, $id){
        $user          = User::find($id);
        $user->status  = $request->status;
        $status        = $user->update();
        if($status){
            $confirmed = "yes";
        }
        else{
            $confirmed = "no";
        }
        return response()->json($confirmed);
    }



    public function profile(){
        $user_id = Auth::user()->id;
        $userinfo = User::find($user_id);
        $userrole = $userinfo->roles->first();
        foreach ($userinfo->roles as $role){
            $permission_count = $role->permissions->count();
        }

        foreach ($userinfo->roles as $roles){
            $modules_count = $roles->modules->count();
        }
        return view('admin.profile.profile',compact('userinfo','permission_count','modules_count','userrole'));

    }
}
