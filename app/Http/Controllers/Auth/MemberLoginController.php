<?php



namespace App\Http\Controllers\Auth;



use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use Auth;
use App\FundInformation;

class MemberLoginController extends Controller

{
    use AuthenticatesUsers;

    protected $guard = 'member';


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
        $fund = FundInformation::find(1);
        return view('auth.memberLogin',compact('fund'));
    }

    public function login(Request $request)
    {
        if (Auth::guard('member')->attempt(['mem_card_id' => $request->mem_card_id, 'password' => $request->password])) {
            Auth::shouldUse('member');
            return redirect('mMember')->with('status', 'login');
        }
        return redirect()->back()->withInput($request->input())->withErrors(['mem_card_id' => 'เลขประจำตัวประชาชน หรือ รหัสผ่านไม่ถูกต้อง.']);
    }

}
