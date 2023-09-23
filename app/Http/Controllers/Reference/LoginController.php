<?php

namespace App\Http\Controllers\Reference;

use App\Http\Controllers\Controller;
use App\Models\ReferenceInformation;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.reference-login');
    }

    // Handle the employee login
    public function login(Request $request)
    {
        // Validate the login data (username and password)
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|string',
//        ]);

        $this->validateLogin($request);

        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        $employee = ReferenceInformation::where('email',$request['email'])->first();

        if (Auth::guard('agent')->attempt(['email' => $request->email, 'password' =>  $request->password])) {
            $user = Auth::guard('agent')->user();
            if($user->status == 'discontinued'){
                $request->session()->flush();
                return redirect()->route('reference.login')->with('error', 'This account is not activated. Please contact the administrator.');
            }else if($user->status == 'continued'){
                session()->put('role_id',$user->role->id);
                // return redirect()->route('dashboard');
            }
            return redirect()->route('dashboard');
        }

        // Authentication failed; redirect back to the employee login form
        return redirect()->route('reference.login')->with('error', 'Login credentials do not match.');
    }


    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect()->intended($this->redirectPath());
    }



    /**
     * Get the guard to be used during authentication.
     *
     * @return StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('agent');
    }
}
