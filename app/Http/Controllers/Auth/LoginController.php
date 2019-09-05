<?php

namespace App\Http\Controllers\Auth;

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

    // use AuthenticatesUsers;

    // /**
    //  * Where to redirect users after login.
    //  *
    //  * @var string
    //  */
    // protected $redirectTo = '/home';

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }

    // public function showLoginForm()
    // {
    //     return view('auth.adminLogin');
    // }

    // public function login(Request $request)

    // {

    //     if (auth()->guard('per')->attempt(['p_username' => $request->username, 'p_password' => $request->password])) {

    //         dd(auth()->guard('per')->user());

    //     }



    //     return back()->withErrors(['p_username' => 'Username or password are wrong.']);

    // }
}
