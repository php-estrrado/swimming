<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


use App\Rules\Name;
use App\Models\Admin\Student;
use Validator;

class StudentController extends Controller
{
    public function __construct() {
        $this->middleware('authadmin:admin');
    }
    public function students()
    {
        $data['title']          =   'Users';
        $data['userGroup']      =   'is-expanded active';
        $data['studentMenu']    =   'active';
        $data['students']       =   Student::getStudents();
        return view('admin.pages.students.list', $data);
    }

    public function student($id=0)
    { 
        $data['title']          =   'New Student';
        $data['id']             =   $id;
        $data['userGroup']      =   'is-expanded active';
        $data['studentMenu']    =   'active';
        $data['student']        =   Student::getStudent($id);
        $data['children']       =   Student::getChildren($id);
        if($data['student']){       $data['title'] = $data['student']->name; }
        return view('admin.pages.students.details', $data);
    }
    
    public function disabledStudents(){
        $data['title']          =   'Disabled Students';
        $data['delGroup']       =   'is-expanded active';
        $data['delStudMenu']    =   'active';
        $data['students']       =   Student::getDisabledStudents();
        return view('admin.pages.deleted_students.list', $data);
    }

    public function updateStatus(Request $request)
    {
        $result                 =   Student::updateStatus((object)$request->post()); 
        if($request->post('active') == 1){ $msg = 'Activated successfully!'; }else{ $msg = 'Deactivated sucessfully!'; }
        if($result){ return array('type'=>'success','msg'=>$msg); }else{  return array('type'=>'warning','msg'=>'Status update failed.'); }
    }

   function disable(Request $request){
        $post                   =   (object)$request->post(); 
        $result                 =   Student::deleteStudent($post);
        if($result){ 
            if($post->userType  ==  'child'){ 
                $data['children']   =   Student::getChildren($post->parent); $data['id'] = $post->parent;
                return view('admin.pages.students.details.children', $data);
            }else{ 
                $data['students']   =   Student::getStudents(); 
                return view('admin.pages.students.list.content', $data);
            }
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
    public function save(Request $request){ // echo '<pre>'; print_r($request->post()); echo '</pre>'; die;
        $post               =   (object)$request->post();
        $rules              =   [
                                    'name'          =>  ['required', 'string', new Name],
                                    'phone'         =>  'required|numeric|digits_between:7,13|unique:users,phone,'.$post->cId.',id',
                                    'email'         =>  'string|email|max:255|unique:users,email,'.$post->cId.',id',
                                //    'address1'      =>  'required|string|max:255'
                                ];
//        if($post->cId       ==  0){ $rules['password']  =   'required|string|min:6|max:55'; }
//        else if($post->password != ''){ $rules['password']  =   'required|string|min:6|max:55'; }
        $validator                      =   Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('/admin/user/student/'.$post->cId)->withErrors($validator)->withInput();
        }else{
            if($post->email     ==  'test@test.com') $post->email = NULL;
            if($post->phone     ==  '0000000') $post->phone = NULL;
            $result         =   Student::saveStudent($post,$post->cId);
            if($result){
                if(isset($post->passType) && $post->passType == 'ajax'){
                    $data['children']   =   Student::getChildren($post->parent); $data['id'] = $post->parent;
                    return view('admin.pages.students.details.children', $data); die;
                }
                if($post->cId > 0){ $mag = 'User Updated Successfully!'; }else{ $mag = 'User Added Successfully!'; }
                return redirect('/admin/user/students')->with('success', $mag);
            }else{ return redirect('/admin/user/student/'.$post->cId)->with('success', 'Failed. Some error occured'); }
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
