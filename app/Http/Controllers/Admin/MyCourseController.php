<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\MyCourse;
use App\Models\Functions;

use Redirect;
use Validator;

class MyCourseController extends Controller
{
    public function __construct() {
        $this->middleware('authadmin:admin');
    }
    public function index()
    {
        //
    }
    
    public function courses(){
        $data['title']          =   'Courses';
        $data['coursesGroup']   =   'is-expanded active';
        $data['regCourseMenu']  =   'active';
        $data['courses']        =   MyCourse::getCourses();
        return view('admin.pages.registered_courses.list', $data);
    }
    
    public function course($id=0){
        $data['id']             =   $id;
        $data['coursesGroup']   =   'is-expanded';
        $data['regCourseMenu']  =   'active';
        $courseDtl              =   MyCourse::getCourse($id);
        $data['course']         =   $courseDtl->course;
        $data['title']          =   "Registered Course of <b> $courseDtl->student</b>";
        $data['medias']         =   MyCourse::getCourseMedias($courseDtl->course->id);
        $data['milestones']     =   MyCourse::getMilestoneDetails($id);
        return view('admin.pages.registered_courses.details', $data);
    }

    function changeStatus(Request $request){
        $post                   =   (object)$request->post();
        $result                 =   MyCourse::updateStatus($post);
        if($request->post('active') == 1){ $msg = 'Activated successfully!'; }else{ $msg = 'Deactivated sucessfully!'; }
        if($result){ 
            $title = $msg       =   $type = '';
            if($post->table     ==  'registered_courses' && $post->field == 'reg_status'){
                if($post->status==  1){ $title = 'Course Approved'; $type = 'course_approved'; $msg = "Your registered course $result->course_name has been approved by Admin. "; }
                else if($post->status ==  4){ $title = 'Course Rejected'; $type = 'course_rejected'; $msg = "Your registered course $result->course_name has been rejected by Admin. "; }
                $student        =   MyCourse::getUserById($result->student_id);
                if($student->parent > 0){ $parent = MyCourse::getUserById($student->parent); $parentNotify = $parent->push_notify; $parentNotify++;  }else{ $parent = false; }
                $pushNotify     =   $student->push_notify; $pushNotify++; 
                $notifyParms    =   ['reg_course_id'=>$result->regId,'student_id'=>$result->student_id];
                Functions::addNotification(0,$result->student_id,$result->regId,$type,$msg,$title);
                Functions::pushNotify($title,$msg,$student->deviceToken,$pushNotify,$type,$notifyParms,$student->os);
                Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
                if($parent){ 
                    Functions::pushNotify($title,$msg,$parent->deviceToken,$parentNotify,$type,$notifyParms,$parent->os); 
                    Functions::updateNotifyCount($parent->user_id,$parentNotify,'push_notify');
                }
            }
            $data['courses']    =   MyCourse::getPendingApprovalCourses();
            return view('admin.pages.registered_courses.list.pending_content', $data);
        }else{  return array('type'=>'warning','msg'=>'Status update failed.'); }
    }

    public function save(Request $request){ 
       $post                    =   (object)$request->post();
       $genRules                =   [
                                        'course_name'       =>  'required|string', 'location' => 'required|string',
                                        'course_desc'       =>  'required|string|max:1500', 'coach' => 'required',
                                        'start_date'        =>  'required', 'end_date' => 'required','closing_date' => 'required'
                                    ];
        $validator              =   Validator::make($request->post('gen'), $genRules);
        if ($validator->fails()) {
            return redirect('/admin/course/'.$post->cId)->withErrors($validator)->withInput();
        }else{
            $result             =   MyCourse::saveCourse($post,$post->cId);
            if($result){
                if($post->cId > 0){ $mag = 'Course Updated Successfully!'; }else{ $mag = 'Course Added Successfully!'; }
                return redirect('/admin/course/'.$result)->with('success', $mag);
            }else{ return redirect('/admin/course/'.$post->cId)->with('error', 'Failed. Some error occured'); }
        }
    }
    
    function uploadCourseMedia(Request $request){ 
        $post                   =   (object) $request->post();
        return MyCourse::uploadMedia($post);
    }
    
    function disable(Request $request){
        $post                   =   (object)$request->post();
        $result                 =   MyCourse::deleteCourse($post);
        if($post->table         ==  'courses'){ $data['courses']    =   MyCourse::getCourses(); }
        else if($post->table    ==  'badges'){ $data['badges']      =   MyCourse::getBadges(); }
        if($result){ 
            if($post->table     ==  'courses' || $post->table       ==  'badges'){
                return view('admin.pages.'.$post->table.'.list.content', $data);
            }else{ return 1; }
        }else{  return array('type'=>'warning','msg'=>'Failed to delete.'); }
    }
    
    function pendingApprovels(){
        $data['title']          =   'Pending Approvals';
        $data['coursesGroup']   =   'is-expanded active';
        $data['penAppMenu']     =   'active';
        $data['courses']        =   MyCourse::getPendingApprovalCourses();
        return view('admin.pages.registered_courses.pending_list', $data);
    }
    
    
    function saveMilestone(Request $request){
        $post                   =   (object)$request->post();
        $genRules                =   [ 'ms_name'       =>  'required|string' ];
        $validator              =   Validator::make($request->post(), $genRules);
        if ($validator->fails()) {
            return redirect('/admin/course/'.$post->cId)->withErrors($validator)->withInput();
        }else{
            $result             =   MyCourse::saveMilestone($post,$post->id);
            $data['milestones'] =   MyCourse::getMilestoneDetails($post->cId);
            $data['id']         =   $post->cId;
            return view('admin.pages.courses.details.milestones', $data);
        }
    }
    
    function saveActivity(Request $request){
        $post                   =   (object)$request->post();
        $genRules                =   [ 'act_name' =>  'required|string', 'act_name' => 'required|string' ];
        $validator              =   Validator::make($request->post(), $genRules);
        if ($validator->fails()) {
            return redirect('/admin/course/'.$post->cId)->withErrors($validator)->withInput();
        }else{
            $result             =   MyCourse::saveActivity($post,$post->id); 
            $data['activities'] =   MyCourse::getActivities($post->ms_id);
            $data['id']         =   $post->cId;
            $data['msId']       =   $post->ms_id; 
            return view('admin.pages.courses.details.activities', $data);
        }
    }
    
    function activityMedias(Request $request){
        $post                   =   (object) $request->post();
        $data['medias']         =   MyCourse::getActivityMedia($post);
        return view('admin.pages.registered_courses.details.media_content_modal', $data);
    }
    
    function deleteMedia(Request $request){
        return MyCourse::deleteMedia((object)$request->post());
    }
    
    public function badges(){
        $data['title']          =   'Badges';
        $data['coursesGroup']   =   'is-expanded active';
        $data['badgeMenu']      =   'active';
        $data['badges']         =   MyCourse::getBadges();
        return view('admin.pages.badges.list', $data);
    }
    
    function sessionRequests(){
        $data['title']          =   'Session Requests';
        $data['coursesGroup']   =   'is-expanded active';
        $data['sessioneMenu']   =   'active';
        $data['activities']     =   MyCourse::getSessionRequests();
        return view('admin.pages.session.list', $data);
    }
    
    function sessionRequest($id=0){
        $data['coursesGroup']   =   'is-expanded active';
        $data['sessioneMenu']   =   'active';
        $data['id']             =   $id;
        $data['session']        =   MyCourse::getSessionRequest($id);
        if($data['session']){
            $data['title']      =   $data['session']->activity_name;
            return view('admin.pages.session.details', $data);
        }else{ return redirect('/admin/activity/session/requests'); }
    }
    
    function saveSession(Request $request){
        $post                   =   $request->post();
        $gen                    =   $post['gen'];
        $genRules               =   [ 'description' =>  'required|string', 'submited_at' => 'required|string' ];
        $validator              =   Validator::make($gen, $genRules);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }else{ 
            $result             =   MyCourse::updateSessionRequest($post);
            if($result){ return redirect('/admin/activity/session/requests')->with('success', 'Request Updated Successfully!'); }
            else{ return redirect('/admin/activity/session/requests'); }
        }
    }
            
    function updateSessionStatus(Request $request){
        return MyCourse::updateSessionStatus((object) $request->post());
    }
}
