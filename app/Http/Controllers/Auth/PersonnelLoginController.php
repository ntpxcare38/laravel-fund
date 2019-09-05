<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
use App\FundInformation;

class PersonnelLoginController extends Controller

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



    protected $guard = 'personnel';



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

    public function __construct()

    {

        $this->middleware('guest')->except('logout');

    }



    public function showLoginForm()
    {
        $fund = FundInformation::where('fund_id','=',1)->first();
        return view('auth.personnelLogin',compact('fund'));

    }



    public function login(Request $request)
    {
        if (auth()->guard('personnel')->attempt(['p_username' => $request->username, 'password' => $request->password,'type_pid' => 1])) {
            Auth::shouldUse('personnel');
            //dd(auth()->guard('personnel')->user());
            return redirect('mAdmin')->with('status', 'login');
        }else if(auth()->guard('personnel')->attempt(['p_username' => $request->username, 'password' => $request->password,'type_pid' => 2])){
            Auth::shouldUse('personnel');
            return redirect('mBoard')->with('status', 'login');
        }else if(auth()->guard('personnel')->attempt(['p_username' => $request->username, 'password' => $request->password,'type_pid' => 3])){
            Auth::shouldUse('personnel');
            return redirect('mOfficer')->with('status', 'login');
        }

        return redirect()->back()->withInput($request->input())->withErrors(['username' => 'username หรือ password ไม่ถูกต้อง.']);
    }

    public function logout(Request $request) {

        $this->guard()->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/home');
    }

}
