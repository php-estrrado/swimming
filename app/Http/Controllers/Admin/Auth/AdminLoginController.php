<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Traits\Admin\EmailTrait;
use Redirect;
use Auth;
use Validator;

class AdminLoginController extends Controller {
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

use AuthenticatesUsers,
    EmailTrait;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm() {
        if (!Auth::guard('admin')->check()) {
            $data = [];
            return view('admin.auth.login', compact('data'));
        } else {
            return Redirect::to('admin');
        }
    }

    public function authenticate(Request $request) {

        $rules = [
            'email' => 'required|email',
            'password' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('admin/login')->withErrors($validator)->withInput(Input::except('password'));
        } else {

            $userdata = [
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'active' => 1,
                'status' => 1
            ];

            if (Auth::guard('admin')->attempt($userdata)) {
                return Redirect::to('admin');
            } else {
                return Redirect::to('admin/login')->withErrors(['Invalid Username or Password']);
            }
        }
    }

}
