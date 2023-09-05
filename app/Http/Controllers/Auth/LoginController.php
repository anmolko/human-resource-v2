<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;



    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function authenticated(Request $request, $user)
    {

        if($user->status == 0){
            $request->session()->flush();
            return redirect()->route('login')->with('error', 'This account is not activated. Please contact the administrator.');
        }else if($user->status == 1){
            session()->put('role_id',Auth::user()->roles[0]->id);
            if (is_null($user->last_login_at)) {
                $is_first_login = "true";
                session()->put('is_first_login',$is_first_login);
                $user->update([
                    'last_login_at' => Carbon::now()->toDateTimeString(),
                    'last_login_ip' => $request->getClientIp()
                ]);

                return redirect()->route('company-setting.index');

            }

            // then here update the last_login_at timestamp
            $user->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);
            return redirect()->intended($this->redirectPath());

            // return redirect()->route('dashboard');
        }


    }

}
