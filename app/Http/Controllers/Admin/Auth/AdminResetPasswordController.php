<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Traits\Admin\EmailTrait;
use Redirect;
use Auth;
use DB;
use Validator;
use Session;

class AdminResetPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset requests
      | and uses a simple trait to include this behavior. You're free to
      | explore this trait and override any methods you wish to tweak.
      |
     */

use EmailTrait;

    /**
     * Where to redirect users after resetting their password.
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

    public function showResetPasswordForm($token) {
        if (!Auth::guard('admin')->check()) {

            $tokenData = DB::table('admin_password_resets')->where('token', $token)->first();

            if ($tokenData) {

                $date = date('Y-m-d H:i:s');

                $validtoken = $tokenData->token;
                $datecreated = $tokenData->created_at;

                $interval = dateDiffInDays($datecreated, $date);

                if ($interval == 0) {
                    return view('admin.auth.reset', compact('validtoken'));
                } else if ($interval >= 1) {
                    return Redirect::to('admin/password/reset/');
                }
            } else {
                return Redirect::to('admin/password/reset/');
            }
        } else {
            return Redirect::to('admin');
        }
    }

    public function resetPassword(Request $request) {
        if (!Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');
            $token = $request->input('token');
            $flashtype = 2;

            $rules = [
                'email' => 'required|email|max:55',
                'password' => 'required|string|min:5',
                'cpassword' => 'required|string|min:5|same:password'
            ];

            $messages = [
                'password.required' => 'The password field is required.',
                'cpassword.required' => 'The confirm password field is required.',
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
                'email.max' => 'The maximum length for email is 55.',
                'password.min' => 'The minimum length for password is 5.',
                'cpassword.min' => 'The minimum length for confirm password is 5.',
                'cpassword.same' => 'Enter confirm password same as password.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['msg' => $validator->errors(), 'type' => 'valerror']);
            } else {

                $email = $request->input('email');
                $password = $request->input('password');

                $whereData = [
                    ['email', '=', $email],
                    ['status', '=', 1],
                    ['active', '=', 1]
                ];

                $count = DB::table('admins')->where($whereData)->count();

                if ($count > 0) {

                    $tokwhereData = [
                        ['email', '=', $email],
                        ['token', '=', $token]
                    ];

                    $tokenDatacnt = DB::table('admin_password_resets')->where($tokwhereData)->count();

                    if ($tokenDatacnt > 0) {

                        $hashedpassword = Hash::make($password);

                        $data = [
                            'password' => $hashedpassword,
                            'modified_on' => $date,
                        ];

                        $resetdata = [
                            'token' => '',
                            'created_at' => $date,
                        ];

                        DB::beginTransaction();
                        try {

                            DB::table('admins')->where('email', $email)->update($data);
                            DB::table('admin_password_resets')->where('email', $email)->update($resetdata);
                            DB::commit();

                            $msg = "Password Reset Successfully";
                            $type = "success";
                        } catch (Exception $ex) {
                            DB::rollback();
                        }
                    } else {
                        $msg = "Email Id Mismatch";
                        $type = "warning";
                    }
                } else {
                    $msg = "User Not Found";
                    $type = "error";
                }

                if ($flashtype == 1) {
                    Session::put('formmsg', $msg);
                }

                return response()->json(['msg' => $msg, 'type' => $type, 'flashtype' => $flashtype]);
            }
        } else {
            return Redirect::to('admin');
        }
    }

}
