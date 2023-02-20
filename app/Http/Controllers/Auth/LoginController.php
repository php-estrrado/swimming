<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Rules\Usertype;
use App\Rules\Active;
use App\Rules\Disabled;
use App\Rules\Deleted;
use App\Rules\Expired;
use Session;
use Auth;
use DB;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
   
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => ['required', 'string', new Usertype, new Active, new Disabled, new Deleted],
            'password' => 'required|string',
        ]);
    }
    public function authenticated()
    { 
        if(auth()->user()->user_type == 1)
        {
            $userData       =   DB::table('user_details as D')->select('D.*','U.email','U.phone')->join('users as U','D.user_id','=','U.id')
                                ->where('D.user_id', auth()->user()->id)->first();
            Session::put('userData', $userData);
            return redirect('/coach/dashboard');
        } 
        return redirect('/');
    }
    public function logout(Request $request) {
        DB::table('users')->where('id',auth()->user()->id)->update(['last_login' => date('Y-m-d H:i:s')]);
        Auth::logout();
        return redirect('/login');
    }
}
