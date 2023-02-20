<?php

namespace App\Http\Controllers\Coach;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\Coach;
use App\Rules\Name;
use DB;

use Redirect;
use Auth;
use Validator;

use Session;

class CoachController extends BaseController
{
    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function __construct(){
        $this->middleware('auth');
    }
  
    public function index(Request $request){
        $post                       =   $request->post();
        $data['post']               =   $post; 
        $data['userData']           =   Session::get('userData');
        $data['total_students']     =   Coach::getTotalStudents(auth()->user()->id);
        $data['total_courses']      =   Coach::getTotalCourses(auth()->user()->id);
        $data['completed_task']     =   Coach::getCompletedTask(auth()->user()->id);
        $data['pending_task']       =   Coach::getPendingTask(auth()->user()->id);
        return view('coach.pages.dashboard', $data);
    }

    /*public function profile() {
        if (Auth::guard('web')->check()) {
            $membership            =    Shop::getUserMembershipDetails(auth()->user()->membership);
            $expire_date           =    (auth()->user()->expire_date);
            $userData              =    Session::get('userData');
            $shop                  =    Session::get('companyName');
            $countries             =    Shop::getCountries();
            $data                  =    Shop::getProfileData(auth()->user()->id);
            $getCountryCurrency    =    Shop::getCountryCurrency();
            $getTimeZone           =    Shop::getTimeZone();
            $result                =    Shop::getProfileDetailsByMembershipPlan();
          

            return view('shop.pages.profile', compact('data','getCountryCurrency','getTimeZone','userData','shop','countries','membership','expire_date','result'));
        } else {
            return Redirect::to('login');
        }
    }
    }*/
    public function profile()
    {       

            $data['title']              =   'title';
            $data['profile']            =   Coach::getProfile(auth()->user()->id);
            return view('coach.pages.profile', $data);
    }

    function updateProfile(Request $req){
        $post                   =   (object)$req->post();
        $data                   =   ['name'=>$post->name,'phone'=>$post->phone,'email'=>$post->email,'address1'=>$post->address1];
        $rules                  =   [
                                        'name'      =>  ['required', 'string', new Name],
                                        'phone'     =>  'required|numeric|digits_between:7,13|unique:users,phone,'.auth()->user()->id.',id',
                                        'email'     =>  'string|email|max:255|unique:users,email,'.auth()->user()->id.',id',
                                        'address1'  => 'required|string|max:255'
                                    ];
        if($post->password      !=  ''){
            $rules['password']  =  'required|confirmed|min:6';
            $data['password']   =   Hash::make($post->password);
        }
        $validator              =   Validator::make($req->post(), $rules);
        if ($validator->fails()) { return redirect('/coach/profile/')->withErrors($validator)->withInput(); }
        else{
            $result             =   Coach::updateProfile($data,auth()->user()->id);
        }
        if($result){ return redirect('/coach/profile')->with('success', 'Profile updated successfully!'); }
        else{ return redirect('/coach/profile')->with('error', 'Failes to update'); }
    }
}
