<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\Admin\EmailTrait;
use Redirect;
use Auth;
use DB;
use Validator;
use Session;

class AdminForgotPasswordController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Password Reset Controller
      |--------------------------------------------------------------------------
      |
      | This controller is responsible for handling password reset emails and
      | includes a trait which assists in sending these notifications from
      | your application to your users. Feel free to explore this trait.
      |
     */

use EmailTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showForgotPasswordForm() {
        if (!Auth::guard('admin')->check()) {
            $data = [];
            return view('admin.auth.forgot', compact('data'));
        } else {
            return Redirect::to('admin');
        }
    }

    public function sendResetPasswordLink(Request $request) {
        if (!Auth::guard('admin')->check()) {

            $date = date('Y-m-d H:i:s');
            $flashtype = 2;

            $rules = [
                'email' => 'required|email|max:55'
            ];

            $messages = [
                'email.required' => 'The email field is required.',
                'email.email' => 'The email must be a valid email address.',
                'email.max' => 'The maximum length for email is 55.'
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if ($validator->fails()) {
                return response()->json(['msg' => $validator->errors(), 'type' => 'valerror']);
            } else {

                $email = $request->input('email');
                $token = str_random(64);

                $whereData = [
                    ['email', '=', $email],
                    ['status', '=', 1],
                    ['active', '=', 1]
                ];

                $resetData = [
                    'email' => $email,
                    'token' => $token,
                    'created_at' => $date
                ];

                $upresetData = [
                    'token' => $token,
                    'created_at' => $date
                ];

                $count = DB::table('admins')->where($whereData)->count();

                if ($count > 0) {

                    $rcount = DB::table('admin_password_resets')->where('email', $email)->count();

                    DB::beginTransaction();
                    try {

                        if ($rcount > 0) {
                            DB::table('admin_password_resets')->where('email', $email)->update($upresetData);
                        } else {
                            DB::table('admin_password_resets')->insert($resetData);
                        }

                        DB::commit();

                        $tokenData = DB::table('admin_password_resets')->where('email', $email)->first();

                        $adminurl = getAdminUrl();
                        $reseturl = $adminurl . '/password/reset/' . $tokenData->token;
                        $resetlink = '<a href="' . $reseturl . '"><button style="color: #fff;cursor: pointer;border: none;background-color: #845ee2;font-size: 15px;line-height: 1.5;justify-content: center;align-items: center;padding: 0 25px;text-transform: uppercase;width: 40%;height: 50px;">Reset Password</button></a>';

                        $mailcontent = EmailTrait::getPasswordResetMailTemplate($resetlink);
                        $result = EmailTrait::sendMail(getAdminEmail(), $email, 'Swim Reset Password Link', $mailcontent);
                        if ($result == 1) {
                            $msg = "Password Reset Mail Sent Successfully";
                            $type = "success";
                        } else {
                            $msg = "Failed to Sent Mail";
                            $type = "error";
                        }
                    } catch (Exception $ex) {
                        DB::rollback();
                    }
                } else {
                    $msg = "User Not Found";
                    $type = "warning";
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
