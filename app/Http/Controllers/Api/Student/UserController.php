<?php

namespace App\Http\Controllers\Api\Student;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\Name;
use App\Rules\ActiveChild;
use App\Models\Api\User;
use App\Models\Functions;
use App\Models\Email;
use DB;
use Mail;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "hi Api";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    { 
        $post           =   (object) $request->post(); // return array('status'=>'success','message'=>'OTP sent','data'=>smsCredientials());
        $validator      =   Validator::make($request->all(), [
                            'name' => ['required', 'string', new Name],
                            'phone' => 'required|numeric|digits_between:7,13|unique:users',
                            'email' => 'required|string|email|max:255|unique:users'
                        ]);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }else{ return User::saveTempUser($post); }
    }
    
    function resendOtp(Request $request){
        $post                   =   (object) $request->post();  
        $rules                  =   ['phone' => 'required|numeric|digits_between:7,13', 'otp_type' => 'required|string|'];
        $validator      =   Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }else{ 
            if($post->otp_type  ==  'register'){ return User::resendRegisterOtp($post); }else if($post->otp_type == 'login'){ return User::resendLoginOtp($post); } 
            else{ return array('status'=>'error','message'=>'Invalid OTP type','data'=>array('errors' =>['otp'=>'Invalid OTP type'])); }
        }
    }
    
    function otp(Request $request){
        $post                   =   (object) $request->post();  
        $rules                  =   ['phone' => 'required|numeric|digits_between:7,13','otp' => 'required|string|', 'otp_type' => 'required|string|'];
        if($post->otp_type      ==  'login'){ $rules['deviceToken'] =     'required|string|'; }  
        $validator      =   Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }else{ 
            if($post->otp_type  ==  'register'){ return User::saveUser($post); }else if($post->otp_type == 'login'){ return User::getLoginData($post); } 
            else{ return array('status'=>'error','message'=>'Invalid OTP type','data'=>array('errors' =>['otp'=>'Invalid OTP type'])); }
        }
    }
        
    function addUserType(Request $request){
        $post                   =   (object) $request->post();
        $rules                  =   ['phone' => 'required|numeric|digits_between:7,13','user_type' => 'required|numeric|'];
        $validator      =   Validator::make($request->all(),$rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }else{ 
            return User::addType($post); 
        }
    }
    
    function addNewChild(Request $request){
        $post           =   (object) $request->post(); // return array('status'=>'error','data'=>array('errors' =>$post));
        $validator      =   Validator::make($request->post(), ['phone' => 'required|numeric|digits_between:7,13']);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        foreach($post->child as $k=>$child){ 
            $rule       =   ['name' => ['required', 'string', new Name],'relation' => 'required|numeric'];
            if($child['phone'] && $child['phone'] != ''){ $rule['phone']  =   'required|numeric|digits_between:7,13|unique:users';  } 
            if($child['email'] && $child['email'] != ''){ $rule['email']  =   'required|string|email|max:255|unique:users'; }
            $validator  =   Validator::make($post->child[$k], $rule);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error)); die;
            }
        }
        $existNumber    =   User::existParent($post);
        if(!$existNumber){ return array('status'=>'error','message'=>'This number not exist','data'=>array('errors'=>['not_exist'=>'This number not exist or desabled'])); }
        else{ 
            $user       =   $existNumber;
            if(User::isChildRegistered($user)){ return array('status'=>'error','message'=>'Please login','data'=>array('errors'=>['login'=>'Please login and add child'])); }
        }
        return User::saveChild($post->child,$user); 
    }
    
    function addChild(Request $request){
        $post                       =   (object) $request->post(); // return array('status'=>'error','data'=>array('errors' =>$post));
        $user                       =   validateToken($post->accesToken);
        if($user){ 
            if($user->is_parent     ==  0){ return array('status'=>'error','message'=>'You have no access','data'=>array('errors'=>['add_child'=>$post])); }
            if(isset($post->child)){    foreach($post->child    as $k=>$child){ 
                $rule               =   ['name' => ['required', 'string', new Name],'relation' => 'required|numeric'];
                if($child['phone']  &&  $child['phone'] != ''){ $rule['phone']  =   'required|numeric|digits_between:7,13|unique:users';  } 
                if($child['email']  &&  $child['email'] != ''){ $rule['email']  =   'required|string|email|max:255|unique:users'; }
                $validator          =   Validator::make($post->child[$k], $rule);
                if ($validator->fails()) {
                    foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                    return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
                }
            } }else{
                return array('status'=>'error','message'=>'No Child Detail found','data'=>array('errors'=>['add_child'=>'Child detail required']));
            }
            return User::saveChild($post->child,$user); 
        }else{ return Functions::invalidToken(); }
    }
    
    function login(Request $request){
        $post                           =   (object)$request->post();  
        $validator                      =   Validator::make($request->all(), ['phone' => 'required|numeric|digits_between:7,13',]);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }else{ return User::login($post); }
        
    }
    
    function relationships(){
        $relationships                  =   DB::table('relationships')->get();
        return array('status'=>'success','message'=>'Relationship','data'=>array('relationships'=>$relationships));
    }

    function profile(Request $request){
        if($user = validateToken($request->post('accesToken'))){ return User::Profile($user); }else{ return Functions::invalidToken(); }
    }
    
    function updateProfile(Request $request){
        $user                           =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        $rules                          =   ['phone'=>'required|numeric|digits_between:7,13|unique:users,phone,'.$user->id.',id','name'=>['required', 'string', new Name]];
        if($request->post('child_id')){ $childId = $request->post('child_id'); }else{ $childId = 0; }
        if($childId > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; }
        if($request->post('email')      !=  ''){ $rules['email'] = 'string|email|max:255|unique:users,email,'.$user->id.',id'; }
        if($request->post('avthar')     !=  ''){ $rules['avthar'] = 'mimes:jpeg,jpg,png|max:2500'; }
        $validator                      =   Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        return User::updateProfile($user,$childId,(object)$request->post(),$request->file('avthar'));
    }
    
//    
//   name' => ['required', 'string', new Name],
//                            'phone' => 'required|numeric|digits_between:7,13|unique:users',
//                            'email' => 'required|string|email|max:255|unique:users' 
    
    
    
    
    public function sendActivationMail($user, $userData){
        $msg                            =   '<h4>Hi, '.$userData['name'].' </h4>';
        $msg                            .=  'Thanks for registering with '.geSiteName().' You can activate your account throuth this <a href="'.url('/account/activate/'.$user["active_link"]).'">Activate</a> link.';
        return Email::sendEmail(geAdminEmail(), $user['email'], 'New Registration',$msg);
    }
    public function accountActivate($token){ 
        $user                           =   DB::table('users')->where('active_link',$token)->first();
        if($user){
            if($user->active == 1){ 
                return redirect('/login')->with('warning', 'You are already activated your account. Please login'); 
            }else{
                DB::table('users')->where('id',$user->id)->update(['active_link' => '', 'active' => 1]);
                return redirect('/login')->with('success', 'Your account has been activated successfully! You can login now'); 
            }
        }else{ return redirect('/login')->with('error', 'Invalid activation link.');  }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request){
        $post               =   $request->post();
        $validator  =   Validator::make($request->all(), [
                            'email' => 'required|string|email|max:255',
                        ]);
        if ($validator->fails()) { 
            $msg            =   'The email must be a valid email address.';
            return array('status'=>'error','message'=>$msg,'data'=>array('errors' =>array('error1'=>$msg)));
        }
        $res                =   User::sendResrtPassLink($post);
        if($res){ 
            if($res         ==  1){
                
                $mag        =   "Reset password link sent to your registered email!";
                return array('status'=>'success','message'=>$mag,'data'=>array('success' =>array('msg'=>$mag)));
            }else{
                return array('status'=>'error','message'=>'This account not activated yet.','data'=>array('errors' =>array('error1'=>'This account not activated yet.')));
            }
        }else{ 
            $msg            =   "We can't find a user with that e-mail address.";
            return array('status'=>'error','message'=>$msg,'data'=>array('errors' =>array('error1'=>$msg)));
        }
    }
    public function resetPassword($token){ // echo $token; die;
        $user                           =   DB::table('users')->where('active_link',$token)->first();
        if($user){
       //     DB::table('users')->where('id',$user->id)->update(['active_link' => '']);
            return view('auth.passwords.reset', compact('user'));
        }else{ return redirect('/login')->with('error', 'Invalid authentication link.');  }
    }
    public function updatePassword(Request $request)
    {
        $post       =   $request->post();
        $validator  =   Validator::make($request->all(), [
                            'password' => 'required|string|min:4|confirmed',
                        ]);
         if ($validator->fails()) {
            return redirect('reset/password/'.$post['active_link']) ->withErrors($validator) ->withInput();
        }else{
            $password               =   Hash::make($post['password']);
            $user                   =   DB::table('users')->where('active_link',$post['active_link'])->first();
            if($user){
                DB::table('users')->where('id',$user->id)->update(['active_link' => '','password'=>$password]);
                return redirect('/login')->with('success', 'Password reset successfully'); 
            }else{ return redirect('/login')->with('error', 'Invalid authentication link.');  }
        }
    }
    function childrenList(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($user){ return User::getChildrenList($user); }else{ return Functions::invalidToken(); }
    }
}
