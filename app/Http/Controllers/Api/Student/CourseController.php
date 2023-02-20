<?php

namespace App\Http\Controllers\Api\Student;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Rules\ActiveChild;
use App\Rules\DisabledChild;
use App\Rules\DeletedChild;
use App\Models\Api\Course;
use App\Models\Functions;
use App\Models\Email;
use DB;
use Mail;
use App\Http\Resources\User as UserResource;
use App\Http\Controllers\Controller;

class CourseController extends Controller
{
    public function index()
    {
        echo "hi Api";
    }

    public function courseList(Request $request)
    { 
        $user               =   validateToken($request->post('accesToken'));
        if($user){ 
            $validator      =   Validator::make($request->post(), ['accesToken' => 'required|string']);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }else{ return Course::getCourses($user); }
        }else{ return Functions::invalidToken(); }
    }
    
    function locations(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        return Course::getLocations($request->post('search'),$user->id);
    }
    
    function locationCourseList(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($user){ 
            $rules              =   ['location' => 'required|numeric'];
            if($request->post('child_id')){ $child = $request->post('child_id'); }else{ $child = 0; }
            if($child > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; }
            $validator          =   Validator::make($request->post(), $rules);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }else{ return Course::getCourses($user,(int)$request->post('location'),$child); }
            
        }else{ return Functions::invalidToken(); }
    }
    
    function locationNotify(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($user){ 
            $validator          =   Validator::make($request->post(), ['location' => 'required|numeric']);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }else{ return Course::saveNotifyLog($user,(int)$request->post('location')); }
            
        }else{ return Functions::invalidToken(); }
    }
    
    function courseDetail(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($user){ 
            $rules              =   ['course_id' => 'required|numeric'];
            if($request->post('child_id')){ $child = $request->post('child_id'); }else{ $child = 0; }
            if($child > 0){ $rules['child_id']  =   ['required', 'numeric', new DeletedChild, new ActiveChild, new DisabledChild]; }
            $validator          =   Validator::make($request->post(), $rules);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }else{ return Course::getCourseDetail($user,(int)$request->post('course_id'),$child); }
            
        }else{ return Functions::invalidToken(); }
    }
    
    function badgeList(Request $request){
        if(validateToken($request->post('accesToken'))){ return Course::getBadgeList(); }else{ return Functions::invalidToken(); }
    }
    
    function registerCourse(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($user){ 
            $rules              =   ['course_id' => 'required|numeric'];
            if($request->post('child_id')){ $child = $request->post('child_id'); }else{ $child = 0; }
            if($child > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; }
            $validator          =   Validator::make($request->post(), $rules);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }else{ return Course::registerCourse($user,$child,(int)$request->post('course_id')); }
        }else{ return Functions::invalidToken(); }
    }
    
    function myCourses(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($request->post('child_id')){ $child = $request->post('child_id'); }else{ $child = 0; }
        if($child > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; 
            $validator          =   Validator::make($request->post(), $rules);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }
        }
        if($user){ return Course::getMyCourses($user->id,$user->is_parent, (int)$child); }else{ return Functions::invalidToken(); }
    }
    
    function myActivities(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if($request->post('child_id')){ $child = $request->post('child_id'); }else{ $child = 0; }
        if($child > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; 
            $validator          =   Validator::make($request->post(), $rules);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }
        }
        if($user){ return Course::getMyActivities($user->id,$user->is_parent, (int)$child,(object)$request->post()); }else{ return Functions::invalidToken(); }
    }
    
    function activityDetail(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        $rules                  =   ['activity_id' => 'required|numeric'];
        if($request->post('child_id')){ $child = $request->post('child_id'); }else{ $child = 0; }
        if($child > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; }
        $validator          =   Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        if($user){ return Course::getActivityDetail($user, (int)$child,(object)$request->post()); }else{ return Functions::invalidToken(); }
    }
    
    function submitActivity(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        $rules                  =   ['activity_id' => 'required|numeric','description' => 'required|string'];
        if($request->post('child_id')){ $childId = $request->post('child_id'); }else{ $childId = 0; }
        if($childId > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; }
        $validator          =   Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        if($user){ return Course::submitActivity($user, (int)$childId,(object)$request->post()); }else{ return Functions::invalidToken(); }
    }
    
    function submitActivityMedia(Request $request){
        $user                   =   validateToken($request->post('accesToken'));
        if(!$user){     return      Functions::invalidToken(); }
        $rules                  =   ['activity_id' => 'required|numeric','media' => 'required|mimes:jpeg,jpg,png,mp4,3gp|max:250000'];
        if($request->post('child_id')){ $childId = $request->post('child_id'); }else{ $childId = 0; }
        if($childId > 0){ $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; }
        $validator          =   Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        if($user){ return Course::submitActivityMedia($user, (int)$childId,(object)$request->post(),$request->file('media')); }
    }
    
    function deleteActivity(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        $validator              =   Validator::make($request->post(), ['media_id'=>['required','numeric']]);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        return Course::deleteMedia($user, (object)$request->post());
    }
}
