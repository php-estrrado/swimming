<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Models\Admin\Course;

use Redirect;
use Validator;

class CourseController extends Controller
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
        $data['courseMenu']     =   'active';
        $data['courses']        =   Course::getCourses();
        return view('admin.pages.courses.list', $data);
    }
    
    public function course($id=0){
        $data['id']             =   $id;
        $data['title']          =   'Course';
        $data['coursesGroup']   =   'is-expanded';
        $data['courseMenu']     =   'active';
        $data['courseDtl']      =   Course::getCourse($id);
        $data['medias']         =   Course::getCourseMedias($id);
        $data['milestones']     =   Course::getMilestoneDetails($id);
        return view('admin.pages.courses.details', $data);
    }

    function changeStatus(Request $request){
        $result                 =   Course::updateStatus((object)$request->post());
        if($request->post('active') == 1){ $msg = 'Activated successfully!'; }else{ $msg = 'Deactivated sucessfully!'; }
        if($result){ return array('type'=>'success','msg'=>$msg); }else{  return array('type'=>'warning','msg'=>'Status update failed.'); }
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
            $result             =   Course::saveCourse($post,$post->cId);
            if($result){
                if($post->cId > 0)
                { 
                    $mag = 'Course Updated Successfully!'; 
                    return redirect('/admin/courses')->with('success', $mag);
                }
                else
                {
                    $mag = 'Course Added Successfully!'; 
                    return redirect('/admin/course/'.$result)->with('success', $mag);
                }
                
            }
            else
            {
                return redirect('/admin/course/'.$post->cId)->with('error', 'Failed. Some error occured'); 
                
            }
        }
    }
    
    function uploadCourseMedia(Request $request){ 
        $post                   =   (object) $request->post();
        return Course::uploadMedia($post);
    }
    
    function disable(Request $request){
        $post                   =   (object)$request->post();
        $result                 =   Course::deleteCourse($post);
        if($post->table         ==  'courses'){ $data['courses']    =   Course::getCourses(); }
        else if($post->table    ==  'badges'){ $data['badges']      =   Course::getBadges(); }
        if($result){ 
            if($post->table     ==  'courses' || $post->table       ==  'badges'){
                return view('admin.pages.'.$post->table.'.list.content', $data);
            }else{ return 1; }
        }else{  return array('type'=>'warning','msg'=>'Failed to delete.'); }
    }
    
    function pendingApprovels(){
        $data['title']          =   'Pending Approvals';
        $data['coursesGroup']   =   'is-expanded active';
        $data['paCourseMenu']   =   'active';
        $data['courses']        =   Course::getPendingApprovalCourses();
        return view('admin.pages.courses.list', $data);
    }
    
    
    function saveMilestone(Request $request){
        $post                   =   (object)$request->post();
        $genRules                =   [ 'ms_name'       =>  'required|string' ];
        $validator              =   Validator::make($request->post(), $genRules);
        if ($validator->fails()) {
            return redirect('/admin/course/'.$post->cId)->withErrors($validator)->withInput();
        }else{
            $result             =   Course::saveMilestone($post,$post->id);
            $data['milestones'] =   Course::getMilestoneDetails($post->cId);
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
            $result             =   Course::saveActivity($post,$post->id); 
            $data['activities'] =   Course::getActivities('ms_id',[$post->ms_id]);
            $data['id']         =   $post->cId;
            $data['msId']       =   $post->ms_id; 
            return view('admin.pages.courses.details.activities', $data);
        }
    }
    
    function activityMedias(Request $request){
        $post                   =   (object) $request->post();
        $data['medias']         =   Course::getActivityMedia($post);
        return view('admin.pages.courses.details.media_content_modal', $data);
    }
    
    function deleteMedia(Request $request){
        return Course::deleteMedia((object)$request->post());
    }
    
    function assignedActivities(Request $request){
        $post                   =   (object) $request->post();
        $data['assigned']       =   Course::getAssActivities($post->ms_id,$post->group_id,1);
        $data['unAssigned']     =   Course::getAssActivities($post->ms_id,$post->group_id,0);
        return view('admin.pages.courses.details.group_model_activities', $data);;
    }
    
    function saveGroup(Request $request){
        $post                   =   $request->post();
        $group                  =   $post['group'];
        $activities             =   $post['act'];
        $grId                   =   $post['group_id']; 
        $res                    =   Course::saveGroup($group,$grId,$activities);
        if($res){
            Course::updateGroupActivities($activities,$group['ms_id'],$res);
            if($grId >0){ $msg  =   'Group updated successfully!'; }else{ $msg = 'Group added successfully!'; }
            $result['status']   =   'success'; $result['msg'] = $msg; 
        }else{ $result['error'] =   'success'; $result['msg'] = 'Error occured. Please try after some time.';  }
        $data['groups']         =   Course::getGroupDetails($group['ms_id']);
        return view('admin.pages.courses.details.activity_groups', $data);;
    }
    
    function deleteGroup(Request $request){ return Course::deleteGroup((object)$request->post()); }

    public function badges(){
        $data['title']          =   'Badges';
        $data['coursesGroup']   =   'is-expanded active';
        $data['badgeMenu']      =   'active';
        $data['badges']         =   Course::getBadges();
        return view('admin.pages.badges.list', $data);
    }
    
    function saveBadge(Request $request){
        $post                   =   (object)$request->post();
        $file                   =   (object)$request->file();
        $result                 =   Course::saveBadge($post,$file);
        if($result){
            if($result          ==  'exist'){ return Redirect::back()->with('error', $post->title.' badge already exist'); }
            if($post->bid       >   0){ $msg = 'Badge updated successfully!'; }else{ $msg = 'Badge added successfully!'; }
            return Redirect::back()->with('success', $msg);
        }else{ return Redirect::back()->with('error', 'Some error occured. Please try after some time.'); }
    }
    
}
