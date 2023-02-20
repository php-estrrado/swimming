<?php

namespace App\Models\Coach;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Course extends Model {
    static function courses($userId){
        $where                  =   [['R.coach_id','=',$userId],['R.active','=',1],['R.status','=',1]];
        $query                  =   DB::table('registered_courses as R')->select('R.*','C.*','R.id as regId','L.name')
                                    ->join('courses as C','R.course_id','=','C.id')->join('cities as L','C.location','=','L.id')->where($where)->groupBy('course_id');
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->students      =   sizeof(DB::table('registered_courses as R')->where($where)->groupBy('student_id')->get());
            $data[]             =   $row;
        } }else{ $data          =   false; }
        return $data;
    }
    
    static function course($userId,$id){
        $where  =   [['R.id','=',$id],['R.coach_id','=',$userId],['R.active','=',1],['R.status','=',1]];
        return      DB::table('registered_courses as R')->select('R.*','C.*','R.id as regId','L.name')
                        ->join('courses as C','R.course_id','=','C.id')->leftJoin('cities as L','C.location','=','L.id')->where($where)->first();
    }
    
    static function getMediaByCourseId($id){ return DB::table('course_media')->where('course_id',$id)->where('active',1)->where('status',1)->get(); }
    
    static function getMilestoneDetails($userId,$courseId){
        $query                  =   DB::table('course_milestones')->where('course_id',$courseId)->where('active',1)->where('status',1);
        if($query->count()      >   0){$data = array(); foreach($query->get() as $row){
            $row->activities    =   Course::getActivities('ms_id',[$row->id]);
            $row->groups        =   Course::getGroupDetails($row->id);
            $data[]             =   $row;
        } }else{ return false; }
        return $data;
    }
    
    static function getActivities($field='ms_id',$ids){
        $query                  =   DB::table('course_acivities as A')->select('A.*','G.group_id','G.activity_id')
                                    ->leftJoin('course_group_activities as G','A.id','=','G.activity_id')
                                    ->whereIn('A.'.$field,$ids)->where('A.active',1)->where('A.status',1);
        $data = $media          =   array();
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->groupName  = '';
            $resMedia           =   DB::table('course_acivity_media')->where('activity_id',$row->id)->where('active',1)->where('status',1)->get();
            if($resMedia){ foreach($resMedia as $val){ $media[] = $val;  } $row->media = $media; }else{ $row->media = array(); }
            if($row->group_id   >   0){ 
                $qry            =   DB::table('course_activity_groups as G')->join('course_group_activities as A','G.id','=','A.group_id')
                                    ->where('G.id',$row->group_id)->where('G.active',1)->where('A.status',1)->where('G.status',1)->first();
                if($qry){$group = $qry->group_name; }else{ $group = ''; } 
                $row->groupName =   $group;
            }
            $data[]             =   $row;
        } }
        return $data;
    }
    
    static function getActivityMedia($post){ return DB::table('course_acivity_media')->where('activity_id',$post->id)->where('active',1)->where('status',1)->get(); }
    
    static function getGroupDetails($msId){
        $query                  =   DB::table('course_activity_groups')->where('ms_id',$msId)->where('active',1)->where('status',1);
        $data                   =   [];
        if($query->count()      >   0){ foreach($query->get() as $row){
            $activityIds        =   Course::getActIdsByGroupId($row->id);
           $row->activities     =   Course::getActivities('id',$activityIds);
           $data[]              =   $row;
        } }
        return $data;
    }
    
    static function getActIdsByGroupId($gId){
        $query                  =   DB::table('course_group_activities')->where('group_id',$gId)->where('status',1);
        $actIds                 =   [0];
        if($query->count()      >   0){ foreach($query->get() as $row){ $actIds[]   =   $row->activity_id; } }
        return $actIds;
    }

    static function getStudentsByCourseId($userId,$courseId){
        $data                   =   [];
        $query                  =   DB::table('registered_courses as R')->select('R.*','C.*','R.id as regId','D.user_id','D.name')
                                    ->join('courses as C','R.course_id','=','C.id')->join('user_details as D','R.student_id','=','D.user_id')
                                    ->where('R.course_id',$courseId)->where('R.coach_id',$userId)->where('R.active',1)->where('R.status',1);
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->complete      =   DB::table('registered_course_activities')->where('reg_course_id',$row->regId)->where('curr_status',3)->where('status',1)->count();
            $row->process       =   DB::table('registered_course_activities')->where('reg_course_id',$row->regId)->where('curr_status',2)->where('status',1)->count();
            $row->pending       =   DB::table('registered_course_activities')->where('reg_course_id',$row->regId)->where('curr_status',0)->where('status',1)->count();
            $data[]             =   $row;
        } return $data; }else{ return false; }
    }

static function getAssignCourses($userId) { 
        return DB::table('courses as C')->select('C.*','L.name as location','U.name')
                ->join('cities as L','C.location','=','L.id')->join('user_details as U','C.coach','=','U.user_id')->where('C.status',1)->where('C.coach',$userId)->get();
    }
    

   static function getAssignCourse($id){
        $query                  =   DB::table('courses as C')->select('C.*','L.name as location','U.name')
                ->join('cities as L','C.location','=','L.id')->join('user_details as U','C.coach','=','U.user_id')->where('C.id',$id);
        $course                 =   $query->first();
        $data['course']         =   $courseLocs = $coursecoaches = array();
        if($query->count()       >   0)
        {
            $course->media      =   DB::table('course_media')->where('course_id',$id)->where('active',1)->where('status',1)->get();
            $mStones            =   DB::table('course_milestones')->where([['course_id','=',$id]])->get();
            if($mStones)
                { 
                    foreach($mStones as $mStone)
                    {
                        $mStone->activities =   Course::getActivities('ms_id',[$mStone->id]);
                        $data['mStone'][]   =   $mStone;
                    } 
                }
        }
        $data['course']         =   $course;
        return (object)$data;
    }
    
static function getAssignCourseMedias($courseId)
    { 
        return DB::table('course_media')->where('course_id',$courseId)->where('status',1)->get(); 
    }

    static function getAssignMilestoneDetails($courseId)
    {
        $query                  =   DB::table('course_milestones')->where('course_id',$courseId)->where('status',1);
        if($query->count()      >   0)
            {
                $data = array();
                foreach($query->get() as $row)
                {
                    $row->activities    =   Course::getActivities('ms_id',[$row->id]);
                    $row->groups        =   Course::getGroupDetails($row->id);
                     $data[]             =   $row;
                } 
            }
        else
            { 
            return false;
            }
        return $data;
    }
    static function getSubmitedActivities($userId){
        return  DB::table('submited_activities as S')->select('S.*','A.activity_code','A.activity_name','C.course_code','C.course_name','D.user_id','D.name','L.status_name','R.curr_status')
                    ->join('registered_course_activities as R','S.reg_activity_id','=','R.id')->join('registered_courses as RC','S.reg_course_id','=','RC.id')
                    ->join('course_acivities as A','R.activity_id','=','A.id')->join('courses as C','A.course_id','=','C.id')
                    ->join('user_details as D','S.student_id','=','D.user_id')->join('status_list as L','S.act_status','=','L.id')
                    ->where('RC.coach_id',$userId)->where('S.status',1)->orderBy('S.act_status','asc')->get();
    }
    
    static function getSubmitedActivity($userId,$id){
        return  DB::table('submited_activities as S')->select('S.*','A.activity_code','A.activity_name','C.course_code','C.course_name','D.user_id','D.name','L.status_name','R.curr_status','B.title','M.ms_name')
                    ->join('registered_course_activities as R','S.reg_activity_id','=','R.id')->join('registered_courses as RC','S.reg_course_id','=','RC.id')
                    ->join('course_acivities as A','R.activity_id','=','A.id')->join('courses as C','A.course_id','=','C.id')->leftJoin('badges as B','S.badge_id','=','B.id')
                    ->join('user_details as D','S.student_id','=','D.user_id')->join('status_list as L','S.act_status','=','L.id')->join('course_milestones as M','R.ms_id','=','M.id')
                    ->where('RC.coach_id',$userId)->where('S.status',1)->where('S.id',$id)->first();
    }
    
    static function getSubmitedMedia($userId,$id){
        $query                  =   DB::table('submited_activity_media')->where('submit_id',$id)->where('status',1);
        $data['images']         =   $data['images'] = false;
        if($query->count()      >   0){ foreach($query->get() as $row){
           if($row->type        ==  'image'){ $data['images'][] = $row; }else if($row->type ==  'video'){ $data['videos'][] = $row; }
        } return (object)$data; }else{ return false; }
    }

        static function updateStatus($post){ return  DB::table($post->table)->where('id',$post->id)->update([$post->field=>$post->status]); }
    static function getUserById($id){ return DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.id',$id)->first(); }
    
    static function getSessionRequests($userId){
        return DB::table('request_extra_activity_session as E')->select('E.*','A.activity_code','A.activity_name','S.name','S.user_id')
                ->join('registered_course_activities as RA','E.reg_activity_id','=','RA.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                ->join('user_details as S','E.student_id','=','S.user_id')
                ->where('E.coach_id',$userId)->where('E.status',1)->get();
    }
    
    static function getSessionRequest($userId,$id){
        $result     =   DB::table('request_extra_activity_session as E')->select('E.*','A.activity_code','A.activity_name','S.user_id','S.name','C.name as coach')
                        ->join('registered_course_activities as RA','E.reg_activity_id','=','RA.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                        ->join('user_details as S','E.student_id','=','S.user_id')->join('user_details as C','E.coach_id','=','C.user_id')
                        ->where('E.coach_id',$userId)->where('E.id',$id)->where('E.status',1)->first();
        if($result){ return $result; }else{ return false; }
    }
    
    static function updateSessionRequest($post){
        return DB::table('request_extra_activity_session')->where('id',$post['rId'])->update($post['gen']);
    }

    static function updateSessionStatus($post){
        $req                =   DB::table($post->table)->where('id',$post->id)->first();
        if($req){ 
            DB::table($post->table)->where('id',$post->id)->update([$post->field=>$post->status]);
            if($post->status == 'Approved'){ DB::table('registered_course_activities')->where('id',$req->reg_activity_id)->update(['curr_status'=>0]); }
            $nfType         =   'request_'.strtolower($post->status); $nfMsg = 'Session request hes been '.strtolower($post->status); $nfTitle = 'Session Request '.$post->status;
            return array('type'=>'success','msg'=>'Session Request '.$post->status.' Successfully!','nf_type'=>$nfType,'nf_msg'=>$nfMsg,'nf_title'=>$nfTitle);
        }else{ return array('type'=>'warning','msg'=>'Error occured. Please try after some time'); }
    }
    
    static function saveActivityReview($post){
        DB::table('submited_activities')->where('id',$post->sId)->update(['act_status'=>$post->status,'coach_review'=>$post->coach_review,'badge_id'=>$post->badge]);
        return DB::table('submited_activities')->where('id',$post->sId)->first();
    }
    
    static function getStudentActivities($userId,$id,$sId){
        $stages                 =   [3=>'complete',2=>'inprogress',4=>'rejected',0=>'pending'];
        $data                   =   [];
        foreach($stages         as  $k=>$key){
            $where              =   [['RC.id','=',$id],['RC.student_id','=',$sId],['RC.coach_id','=',$userId],['RA.curr_status','=',$k],['RA.status','=',1]];
            $query              =   DB::table('registered_course_activities as RA')->select('S.*','A.activity_code','A.activity_name','B.title','RA.activity_id')
                                    ->join('registered_courses as RC','RA.reg_course_id','=','RC.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                                    ->leftJoin('badges as B','RA.badge_id','=','B.id')->leftJoin('submited_activities as S','RA.id','=','S.reg_activity_id')->where($where)
                                    ->groupBy('A.id');
            if($k > 0){ $query->orderBy('S.submited_at','desc'); }
            if($query->count()  >   0){ foreach($query->get() as $row){
                $row->group     =   Course::getGroupByActvityId($row->activity_id);
                $data[$key][]   =   $row;
            } }
        }
        return $data;
    }
    
    static function getCourseByRegCId($userId,$regId){ return DB::table('courses as C')->join('registered_courses as R','C.id','=','R.course_id')->where('R.id',$regId)->first(); }
    static function getGroupByActvityId($actId){
        return DB::table('course_group_activities as A')->join('course_activity_groups as G','A.group_id','=','G.id')->where('A.activity_id',$actId)->where('G.status',1)->first();
    }
    static function getBadges($type){ 
        $badges     =   DB::table('badges')->where('active',1)->where('status',1)->get(); 
        if($type    ==  'dropdown'){
           if($badges){ foreach($badges as $row){ $data[$row->id] = $row->title; } return $data; }else{ return array(); } 
        }else{ return $badges; }
        
    }
    
    static function getIncompleteActivities($id){
        $regId                  =   DB::table('registered_course_activities')->where('id',$id)->first()->reg_course_id;
        $count                  =   DB::table('registered_course_activities')
                                    ->where('reg_course_id',$regId)->where('curr_status','!=',3)->where('status',1)->count();
        return ['regId'=>$regId,'count'=>$count];
    }
}
