<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Http\Controllers\Controller;
use App\Models\Admin\Dashboard;
use App\Rules\Name;
use App\Rules\Password;
use Redirect;
use Validator;
use Session;
use Auth;

class DashboardController extends Controller {
    private $dashboard;

    public function __construct() {
        $this->middleware('authadmin:admin');
    }

    public function showDashboard(Request $request) {
        $data['title']          =   'Dashboard'; 
        $data['dashGroup']      =   'is-expanded active';
        $data['homeMenu']       =   'active';
        $data['dashData']       =   Dashboard::getDashboardData(); 
        $data['coaches']        =   Dashboard::getDashboardDetail();
        return view('admin.pages.dashboard.home', $data);
    }

    public function logout() {
        Auth::logout();
        return Redirect::to('admin/login');
    }
    
    function profile(){ 
        $data['title']          =   'Profile'; 
        $data['accountGroup']   =   'is-expanded active';
        $data['profileMenu']    =   'active';
        $data['profile']        =   Dashboard::getProfile(auth()->user()->id);
        return view('admin.auth.profile', $data);
    }
    
    function updateProfile(Request $req){
        $post                   =   (object)$req->post();
        $data                   =   ['name'=>$post->name,'phone'=>$post->phone,'email'=>$post->email];
        $rules                  =   [
                                        'name'      =>  ['required', 'string', new Name],
                                        'phone'     =>  'required|numeric|digits_between:7,13|unique:admins,phone,'.auth()->user()->id.',id',
                                        'email'     =>  'string|email|max:255|unique:admins,email,'.auth()->user()->id.',id'
                                    ];
        if($post->password      !=  ''){
            $rules['curr_password']  =  ['required','string', new Password];
            $rules['password']  =  'required|confirmed|min:6';
            $data['password']   =   Hash::make($post->password);
        }
        $validator              =   Validator::make($req->post(), $rules);
        if ($validator->fails()) { return redirect('/admin/profile/')->withErrors($validator)->withInput(); }
        else{
            $result             =   Dashboard::updateProfile($data,auth()->user()->id);
        }
        if($result){ return redirect('/admin/profile')->with('success', 'Profile updated successfully!'); }
        else{ return redirect('/admin/profile')->with('error', 'Failes to update'); }
    }

    public function fnf() {
        return Redirect::to('admin');
    }

}
