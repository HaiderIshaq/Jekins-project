<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Log;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    function authenticated(Request $request)
    {
        date_default_timezone_set("Asia/Karachi");

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "User Logged In";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = '';
        $log->save();

        $user = Auth::user();
        $token =  $user->createToken('KgtERP')->accessToken;
        session(
            [
                'token' => $token,
            ]
        );

        if($request->user()->role == 5) {
            return redirect()->intended('/banker'); // it will be according to your routes.

        } else {
            return redirect()->intended('/home'); // it also be according to your need and routes
        }


    }

    function logout(Request $request)
    {

        date_default_timezone_set("Asia/Karachi");

        $log = new Log;
        $log->user_id = $request->user()->id;
        $log->activity = "User Logged Out";
        $log->date = date('Y/m/d');
        $log->time = date("h:i:sa");
        $log->service = '';
        $log->save();

        Auth::logout();
        return redirect('/login');
    }
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
