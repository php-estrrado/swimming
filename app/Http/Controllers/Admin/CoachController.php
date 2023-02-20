<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


use App\Rules\Name;
use App\Models\Admin\Coach;
use Validator;
use Redirect;

class CoachController extends Controller
{
    public function __construct() {
        $this->middleware('authadmin:admin');
    }
    public function coaches()
    {
        $data['title']          =   'Coaches';
        $data['userGroup']      =   'is-expanded active';
        $data['coachMenu']      =   'active';
        $data['coaches']        =   Coach::getCoaches();
        return view('admin.pages.coaches.list', $data);
    }
    public function newCoaches()
    {
        $data['title']          =   'New Coaches';
        $data['userGroup']      =   'is-expanded active';
        $data['coachARMenu']    =   'active';
        $data['coaches']        =   Coach::getCoaches('pending');
        return view('admin.pages.coaches.new_list', $data);
    }

    public function coach($id=0)
    { 
        $data['title']          =   'New Coach';
        $data['id']             =   $id;
        $data['userGroup']      =   'is-expanded active';
        $data['coachMenu']      =   'active';
        $data['coach']          =   Coach::getCoach($id);
        $data['locations']      =   Coach::getLocations();
        if($data['coach']){         $data['title'] = $data['coach']->name; }
        return view('admin.pages.coaches.details', $data);
    }
    
    public function disabledCoaches(){
        $data['title']          =   'Disabled Coaches';
        $data['delGroup']       =   'is-expanded active';
        $data['delCoachMenu']   =   'active';
        $data['coaches']        =   Coach::getDisabledCoaches();
        return view('admin.pages.deleted_coaches.list', $data);
    }
    
    function restore($id=0){
        $result                 =   Coach::restoreUser($id);
        if($result){
            return Redirect::back()->with('success', 'User enabled successfully!');
        }else{ return Redirect::back()->with('error', 'Some error occured. please trt after some time'); }
    }

    public function updateStatus(Request $request)
    {
        $result                 =   Coach::updateStatus((object)$request->post()); 
        if($request->post('active') == 1){ $msg = '  Activated successfully!'; }else{ $msg = ' Deactivated sucessfully!'; }
        if($result){ return redirect('/admin/user/coaches/new')->with('success', $msg); }
        else{  return array('type'=>'warning','msg'=>'Status update failed.'); Session::flash('alert-danger', 'Some error occured. Please try after some time.'); }
    }
    
    public function updateNewStatus($id,$status)
    {   $data                   =   ['id'=>$id,'active'=>$status,'table'=>'users'];
        $result                 =   Coach::updateStatus((object)$data); 
        if($status              ==  1){ $msg = 'ch Activated successfully!'; }else{ $msg = 'ch Deactivated sucessfully!'; }
        if($result){ return redirect('/admin/user/coaches/new')->with('success', $msg); }
        else{return redirect('/admin/user/coaches/new')->with('error', 'Some error occured. Please try after some time.'); }
    }

   function disable(Request $request){
        $post                   =   (object)$request->post();
        $result                 =   Coach::deleteCoach($post);
        if($result){ 
            $data['coaches']    =   Coach::getCoaches(); 
            return view('admin.pages.coaches.list.content', $data);
        }else{  return array('type'=>'warning','msg'=>'Failed to delete.'); }
    }
    
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function save(Request $request)
    {
        $post               =   (object)$request->post();
        $rules              =   [
                                    'name'          =>  ['required', 'string', new Name],
                                    'phone'         =>  'required|numeric|digits_between:7,13|unique:users,phone,'.$post->cId.',id',
                                    'email'         =>  'string|email|max:255|unique:users,email,'.$post->cId.',id',
                               //     'address1'      =>  'required|string|max:255',
                                    'location'      =>  'required'
                                ];
        if($post->cId       ==  0){ $rules['password']  =   'required|string|min:6|max:55'; }
        else if($post->password != ''){ $rules['password']  =   'required|string|min:6|max:55'; }
        $validator                      =   Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/admin/user/coach/'.$post->cId)->withErrors($validator)->withInput();
        }else{
            $resukt         =   Coach::saveCoach($post,$post->cId);
            if($resukt){
                if($post->cId > 0){ $mag = 'Coach Updated Successfully!'; }else{ $mag = 'Coach Added Successfully!'; }
                return redirect('/admin/user/coaches')->with('success', $mag);
            }else{ return redirect('/admin/user/coach/'.$post->cId)->with('success', 'Failed. Some error occured'); }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
