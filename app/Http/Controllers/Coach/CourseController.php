<?php

namespace App\Http\Controllers\Coach;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


use App\Models\Coach\Course;
use App\Models\Functions;
use Validator;
use Session;

class CourseController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
  
    public function courses(Request $request){
        $data['coursesGroup']        =   'is-expanded active';
        $data['courseMenu']         =   'active';
        $data['title']              =   'Courses';
        $data['courses']            =   Course::courses(auth()->user()->id);
        return view('coach.pages.courses.list', $data);
    }
    
    public function course($id=0){
        $data['courseGroup']        =   'is-expanded active';
        $data['courseMenu']         =   'active';
        $data['id']                 =   $id;
        $course                     =   Course::course(auth()->user()->id,$id);
        if($course){
            $data['title']          =   $course->course_name;
            $data['course']         =   $course;
            $data['medias']         =   Course::getMediaByCourseId($course->course_id);
            $data['milestones']     =   Course::getMilestoneDetails(auth()->user()->id,$course->course_id);
            $data['students']       =   Course::getStudentsByCourseId(auth()->user()->id,$course->course_id);
            return view('coach.pages.courses.details', $data);
        }else{ return redirect('/coach/courses'); }
        
    }
    
    public function assignCourses(){
         $data['title']          =   'Courses';
         $data['coursesGroup']   =   'is-expanded active';
         $data['regCourseMenu']  =   'active';
         $data['courses']        =   Course::getAssignCourses(auth()->user()->id);
         return view('coach.pages.assigned_courses.list', $data);
     }
    
    public function assignCourse($id=0){
        $data['id']             =   $id;
        $data['coursesGroup']   =   'is-expanded';
        $data['regCourseMenu']  =   'active';
        $courseDtl              =   Course::getAssignCourse($id);
        $data['course']         =   $courseDtl->course;
        $data['title']          =   'View Course';
        $data['medias']         =   Course::getAssignCourseMedias($courseDtl->course->id);
        $data['milestones']     =   Course::getAssignMilestoneDetails($id);
        return view('coach.pages.assigned_courses.details', $data);
    }

    function updateStatus(Request $request){
        $post                       =   (object)$request->post(); 
        $result                     =   Course::updateStatus($post);
        $user                       =   Session::get('userData');
        if($result){
            if($post->table         ==  'submited_activities' && $post->field == 'act_status'){ 
                $post->table        =   'registered_course_activities'; $post->field = 'curr_status'; $post->id = $post->aId;
                $pstStatus          =   $post->status;
                if($post->status    ==  3){
                    $title          =   'Activity Approved'; $type = 'activity_approved';
                    $msg            =   'Submitted activity has been approved by '.$user->name;
                }else if($post->status    ==  4){
                    $title          =   'Activity Rejected'; $type = 'activity_rejected';
                    $msg            =   'Submitted activity has been rejected by '.$user->name;
                    $post->status   =  0;
                }
                Course::updateStatus($post);  
                $post->status       =   $pstStatus;
                $student            =   Course::getUserById($post->student_id);
                if($student->parent > 0){ $parent = Course::getUserById($student->parent); $parentNotify = $parent->push_notify; $parentNotify++;  }else{ $parent = false; }
                $notifyParms        =   ['reg_activity_id'=>$post->aId,'student_id'=>$student->user_id];
                $pushNotify         =   $student->push_notify; $pushNotify++; 
                Functions::addNotification(auth()->user()->id,$student->user_id,$post->aId,$type,$msg,$title);
                Functions::pushNotify($title,$msg,$student->deviceToken,$pushNotify,$type,$notifyParms,$student->os);
                Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
                if($parent){ 
                    Functions::pushNotify($title,$msg,$parent->deviceToken,$parentNotify,$type,$notifyParms,$parent->os); 
                    Functions::updateNotifyCount($parent->user_id,$parentNotify,'push_notify');
                }
                if($post->status    ==  3){
                    $incomplete     =   Course::getIncompleteActivities($post->aId);
                    $pending        =   $incomplete['count'];
                    if($pending     <   3){ $pushNotify++; 
                        $title          =   'Nearing to End'; $type = 'near_to_end';
                        $msg            =   ' have '.$pending.' more  activities pending to complete ';
                        Functions::addNotification(0,$student->user_id,$incomplete['regId'],$type,'You '.$msg,$title);
                        Functions::pushNotify($title,'You '.$msg,$student->deviceToken,$pushNotify,$type,$notifyParms,$student->os);
                        Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
                        if($parent){  $parentNotify++;
                            Functions::pushNotify($title,$student->name.' '.$msg,$parent->deviceToken,$parentNotify,$type,$notifyParms,$parent->os); 
                            Functions::updateNotifyCount($parent->user_id,$parentNotify,'push_notify');
                        }
                    }
                }
                echo 'success'; die;
            }else{ echo 'error'; die; }
        }
    }
    
    function activityMedias(Request $request){
        $post                   =   (object) $request->post();
        $data['medias']         =   Course::getActivityMedia($post);
        return view('coach.pages.courses.details.media_content_modal', $data);
    }
    
    function submitedActivities(){
        $data['coursesGroup']       =   'is-expanded active';
        $data['sActMenu']           =   'active';
        $data['title']              =   'Submitted Activities';
        $data['activities']         =   Course::getSubmitedActivities(auth()->user()->id);
        return view('coach.pages.activities.list', $data);
    }
    
    function submitedActivity($id=0){
        $data['courseGroup']        =   'is-expanded active';
        $data['sActMenu']           =   'active';
        $activity                   =   Course::getSubmitedActivity(auth()->user()->id,$id);
        if($activity){
            $data['title']          =   $activity->activity_name;
            $data['activity']       =   $activity;
            $data['badges']         =   Course::getBadges('dropdown');
            $data['medias']         =   Course::getSubmitedMedia(auth()->user()->id,$id);
            return view('coach.pages.activities.details', $data);
        }else{ return redirect('/coach/submitted/activities'); }
    }
    
    function sessionRequests(){
        $data['coursesGroup']       =   'is-expanded active';
        $data['sessionMenu']        =   'active';
        $data['title']              =   'Session Requests';
        $data['activities']         =   Course::getSessionRequests(auth()->user()->id);
        return view('coach.pages.session.list', $data);
    }
    
    function sessionRequest($id=0){
        $data['courseGroup']        =   'is-expanded active';
        $data['sessionMenu']        =   'active';
        $data['id']                 =   $id;
        $data['session']            =   Course::getSessionRequest(auth()->user()->id,$id);
        if($data['session']){
            $data['title']          =   $data['session']->activity_name;
            return view('coach.pages.session.details', $data);
        }else{ return redirect('/coach/activity/session/requests'); }
    }
    
    function saveSession(Request $request){
        $post                   =   $request->post();
        $gen                    =   $post['gen'];
        $genRules               =   [ 'description' =>  'required|string', 'submited_at' => 'required|string' ];
        $validator              =   Validator::make($gen, $genRules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{ 
            $result             =   Course::updateSessionRequest($post);
            if($result){ return redirect('/coach/activity/session/requests')->with('success', 'Request Updated Successfully!'); }
            else{ return redirect('/coach/activity/session/requests'); }
        }
    }
            
    function updateSessionStatus(Request $request){ 
        $post                   =   (object) $request->post();
        $user                   =   Session::get('userData');
        $result                 =   Course::updateSessionStatus($post);
        if($result['type']      ==  'success'){
            $student            =   Course::getUserById($post->student_id);
            if($student->parent > 0){ $parent = Course::getUserById($student->parent); $parentNotify = $parent->push_notify; $parentNotify++;  }else{ $parent = false; }
            $notifyParms        =   ['id'=>$post->id,'student_id'=>$student->user_id];
            $pushNotify         =   $student->push_notify; $pushNotify++; 
            $msg                =   $result['nf_msg'].' by '.$user->name;
            Functions::addNotification(auth()->user()->id,$student->user_id,$post->id,$result['nf_type'],$msg,$result['nf_title']);
            Functions::pushNotify($result['nf_title'],$msg,$student->deviceToken,$pushNotify,$result['nf_type'],$notifyParms,$student->os);
            Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
            if($parent){ 
                Functions::pushNotify($result['nf_title'],$msg,$parent->deviceToken,$parentNotify,$result['nf_type'],$notifyParms,$parent->os); 
                Functions::updateNotifyCount($parent->user_id,$parentNotify,'push_notify');
            }
        }
        return $result;
    }
    
    function saveActvityReview(Request $request){ 
        $post                   =   (object) $request->post(); // echo '<pre>'; print_r($post); echo '</pre>'; die;
        $rules                  =   [ 'status'  =>  'required', 'coach_review' => 'required|string|max:255', ];
        if($post->status        ==  3){ $rules['badge'] = 'required'; }
        if($post->status        ==  4){ $post->badge = 0; }
        $validator              =   Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $pstStatus          =   $post->status;
            $user               =   Session::get('userData');
            $result             =   Course::saveActivityReview($post);
            if($result){
                $post->table    =   'registered_course_activities'; $post->field = 'curr_status'; $post->id = $result->reg_activity_id;
                if($pstStatus   ==  4){ $post->status = 0; } Course::updateStatus($post);
                $post->status   =   $pstStatus;
                $upd['table']   =   'registered_course_activities'; $upd['id'] = $result->reg_activity_id; $upd['field'] = 'badge_id'; $upd['status'] = $post->badge; 
                Course::updateStatus((object)$upd);
                $status[3]      =   'approved'; $status[4]     =   'rejected'; 
                $type           =   'activity_'.$status[$post->status]; $msg = 'Submitted activity has been '.$status[$post->status].' by '.$user->name; $title = 'Activity '.ucfirst($status[$post->status]);
                $student        =   Course::getUserById($post->student_id);
                if($student->parent > 0){ $parent = Course::getUserById($student->parent); $parentNotify = $parent->push_notify; $parentNotify++;  }else{ $parent = false; }
                $notifyParms    =   ['id'=>$post->sId,'student_id'=>$student->user_id];
                $pushNotify     =   $student->push_notify; $pushNotify++; 
                Functions::addNotification(auth()->user()->id,$student->user_id,$post->sId,$type,$msg,$title);
                Functions::pushNotify($title,$msg,$student->deviceToken,$pushNotify,$type,$notifyParms,$student->os);
                Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
                if($parent){ 
                    Functions::pushNotify($title,$msg,$parent->deviceToken,$parentNotify,$type,$notifyParms,$parent->os); 
                    Functions::updateNotifyCount($parent->user_id,$parentNotify,'push_notify');
                }
                if($post->status    ==  3){
                    $incomplete     =   Course::getIncompleteActivities($result->reg_activity_id);
                    $pending        =   $incomplete['count'];
                    if($pending     <   3){ $pushNotify++; 
                        $title          =   'Nearing to End'; $type = 'near_to_end';
                        $msg            =   ' have '.$pending.' more  activities pending to complete ';
                        Functions::addNotification(0,$student->user_id,$incomplete['regId'],$type,'You '.$msg,$title);
                        Functions::pushNotify($title,'You '.$msg,$student->deviceToken,$pushNotify,$type,$notifyParms,$student->os);
                        Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
                        if($parent){  $parentNotify++;
                            Functions::pushNotify($title,$student->name.' '.$msg,$parent->deviceToken,$parentNotify,$type,$notifyParms,$parent->os); 
                            Functions::updateNotifyCount($parent->user_id,$parentNotify,'push_notify');
                        }
                    }
                }
            }
            return redirect()->back()->with('success', 'Activity '.ucfirst($status[$post->status]).' Successfully!');
        }
    }
    
    function courseStudent($regId,$sId){
        $data['courseGroup']        =   'is-expanded active';
        $data['courseMenu']         =   'active';
        $data['title']              =   'Student Activities';
        $data['id']                 =   $regId; 
        $studActivities             =   Course::getStudentActivities(auth()->user()->id,$regId,$sId);
            $data['courseName']     =   Course::getCourseByRegCId(auth()->user()->id,$regId)->course_name;
            $data['studentName']    =   Course::getUserById($sId)->name;
            $data['activities']     =   $studActivities;
            return view('coach.pages.courses.details.student_activities', $data);
    }
    
    function studSubmitActivity($id,$sid,$aid){
        $data['courseGroup']        =   'is-expanded active';
        $data['sActMenu']           =   'active';
        $activity                   =   Course::getSubmitedActivity(auth()->user()->id,$aid);
        if($activity){
            $data['title']          =   $activity->activity_name;
            $data['activity']       =   $activity;
            $data['badges']         =   Course::getBadges('dropdown');
            $data['medias']         =   Course::getSubmitedMedia(auth()->user()->id,$aid);
            return view('coach.pages.activities.student_details', $data);
        }else{ return redirect("/coach/course/$id/$sid"); }
    }
}
