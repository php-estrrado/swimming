<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\Name;
use App\Models\User;
use App\Models\Email;
use DB;

class UserController extends Controller {

    public function create(Request $request) { 
        $formData = $request->all(); // echo '<pre>'; print_r($formData); echo '</pre>'; die;
        $validator = Validator::make($request->all(), [
                    'name' => ['required', 'string', new Name],
                    'location' => ['required', 'string'],
                    'experience' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'phone' => 'required|numeric|digits_between:7,13',
                    'password' => 'required|string|min:4|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('register')->withErrors($validator)->withInput();
        } else {
            $user['email']              =   $formData['email'];
            $user['phone']              =   $formData['phone'];
            $user['password']           =   Hash::make($formData['password']);
            $user['user_type']          =   $formData['user_type'];
            $userData['name']           =   $formData['name'];
            $userData['city']           =   $formData['location'];
            $userData['experience']     =   $formData['experience'];
       //     $formData['active_link']    =   base64_encode(rand(100000, 999999) . '1' . time() . '1');
         ; 
            
            $userId = DB::table('users')->insertGetId($user);
            if ($userId) {
                $userData['user_id']    =   $userId;
                $userDataId = DB::table('user_details')->insertGetId($userData);
                
                
        //        $mailContent = Email::sendActivationMail($user, $formData);
           //     Email::sendEmail(geAdminEmail(), $user['email'], 'New Registration', $mailContent);
                return redirect('/')->with('success', 'You are successfully registered! After admin approvel, your account will be activate.');
            }
        }
    }

    public function sendActivationMail($user, $userData) {
        $msg = '<h4>Hi, ' . $userData['name'] . ' </h4>';
        $msg .= 'Thanks for registering with ' . geSiteName() . ' After admin approvel, your account will be activate.';
        return Email::sendEmail(geAdminEmail(), $user['email'], 'New Registration', $msg);
    }

    public function accountActivate($token) {
        $user = DB::table('users')->where('active_link', $token)->first();
        if ($user) {
            if ($user->active == 1) {
                return redirect('/login')->with('warning', 'You are already activated your account. Please login');
            } else {
                DB::table('users')->where('id', $user->id)->update(['active_link' => '', 'active' => 1]);
                return redirect('/login')->with('success', 'Your account has been activated successfully! You can login now');
            }
        } else {
            return redirect('/login')->with('error', 'Invalid activation link.');
        }
    }

    public function forgotPassword(Request $request) {
        $post = $request->post();
        $res = User::sendResrtPassLink($post);
        $validator = Validator::make($request->all(), [
                    'email' => 'required|string|email|max:255|unique:users',
        ]);
        if ($res) {
            if ($res == 1) {
                return redirect('/password/reset')->with('success', "Reset password link sent to your registered email!");
            } else {
                return redirect('/password/reset')->with('error', 'This account not activated yet.')->withInput();
                ;
            }
        } else {
            $msg = "We can't find a user with that e-mail address.";
            return redirect('/password/reset')->with('error', $msg)->withInput();
            ;
        }
        print_r($request->post());
    }

    public function resetPassword($token) {
        $user = DB::table('users')->where('active_link', $token)->first();
        if ($user) {
            //     DB::table('users')->where('id',$user->id)->update(['active_link' => '']);
            return view('auth.passwords.reset', compact('user'));
        } else {
            return redirect('/login')->with('error', 'Invalid authentication link.');
        }
    }

    public function updatePassword(Request $request) {
        $post = $request->post();
        $validator = Validator::make($request->all(), [
                    'password' => 'required|string|min:4|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('reset/password/' . $post['active_link'])->withErrors($validator)->withInput();
        } else {
            $password = Hash::make($post['password']);
            $user = DB::table('users')->where('active_link', $post['active_link'])->first();
            if ($user) {
                DB::table('users')->where('id', $user->id)->update(['active_link' => '', 'password' => $password]);
                return redirect('/login')->with('success', 'Password reset successfully');
            } else {
                return redirect('/login')->with('error', 'Invalid authentication link.');
            }
        }
    }

}

