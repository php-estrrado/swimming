<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

namespace App\Models\Admin;

use DB;

class MyCourse extends User {

    static function getCourses() { 
        return DB::table('registered_courses as R')->select('C.*','R.id as regId','R.reg_status','R.registered_at','L.name as location','U.name','S.status_name')
                ->join('courses as C','R.course_id','=','C.id')->join('user_details as U','R.student_id','=','U.user_id')
                ->join('cities as L','C.location','=','L.id')->join('status_list as S','R.reg_status','=','S.id')->where('R.status',1)->get();
    }
    
    static function getCourse($id){
        $query                  =   DB::table('registered_courses as R')->select('C.*','R.id as regId','R.reg_status','R.registered_at','L.name as location','U.user_id','U.name','S.status_name')
                                    ->join('courses as C','R.course_id','=','C.id')->join('user_details as U','R.student_id','=','U.user_id')
                                    ->join('cities as L','C.location','=','L.id')->join('status_list as S','R.reg_status','=','S.id')->where('R.id',$id);
        $course                 =   $query->first();
        $data['course']         =   $courseLocs = $coursecoaches = array(); $data['student'] = 'Student';
        if($query->count()      >   0){
            $data['student']    =   $course->name;
            $course->media      =   DB::table('course_media')->where('course_id',$course->id)->where('active',1)->where('status',1)->get();
            $mStones            =   DB::table('course_milestones')->where([['course_id','=',$course->id]])->get();
            if($mStones){ foreach($mStones as $mStone){  
                $mStone->activities =   MyCourse::getActivities('ms_id',[$mStone->id],$id); 
                $data['mStone'][]   =   $mStone;
            } }
        }
        $data['course']         =   $course;
        return (object)$data;
    }
    
    static function getCourseMedias($courseId){ return DB::table('course_media')->where('course_id',$courseId)->where('status',1)->get(); }
    static function getMilestoneDetails($id){
        $query                  =   DB::table('course_milestones as M')->select('M.*')->join('registered_courses as R','M.course_id','=','R.course_id')
                                    ->where('R.id',$id)->where('M.status',1)->groupBy('M.id');
        if($query->count()      >   0){$data = array(); foreach($query->get() as $row){
            $row->activities    =   MyCourse::getActivities('ms_id',[$row->id],$id); // echo '<pre>'; print_r($row->activities); echo '</pre>';
            $row->groups        =   MyCourse::getGroupDetails($row->id,$id);
            $data[]             =   $row;
        } }else{ return false; }
        return $data;
    }
    
    static function getGroupDetails($msId,$regCId){
        $query                  =   DB::table('course_activity_groups')->where('ms_id',$msId)->where('status',1);
        $data                   =   [];
        if($query->count()      >   0){ foreach($query->get() as $row){
            $activityIds        =   MyCourse::getActIdsByGroupId($row->id);
           $row->activities     =   MyCourse::getActivities('id',$activityIds,$regCId);
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
    
    static function saveCourse($post,$id){ 
        $course                 =   $post->gen;
        if($id                  >   0){ DB::table('courses')->where('id',$id)->update($course); return $courseId = $id; }
        else{ 
            $courseId         =   DB::table('courses')->insertGetId($course); DB::table('courses')->where('id',$courseId)->update(['course_code'=>'SC-'.$courseId]); 
            mkdir(storage_path() . '/app/public/Courses/'.$courseId,0755,TRUE); 
            return $courseId; 
        }
    }
    
    static function uploadMedia($post){
        $data                   =   [$post->field_id=>$post->cId,'file'=>$post->path.$post->file,'type'=>$post->type,'active'=>1];
        $insId                  =   DB::table($post->table)->insertGetId($data);
        if($insId){ echo $insId; }else{ echo 0; } 
    }

    static function updateStatus($post){ 
        $query                  =   DB::table($post->table.' as R')->select('R.*','C.*','R.id as regId')->join('courses as C','R.course_id','=','C.id')->where('R.id',$post->id);
        if($query->count()      >   0){ 
            DB::table($post->table)->where('id',$post->id)->update([$post->field=>$post->status]); 
            if($post->field     ==  'reg_status' && $post->status == 4){ DB::table($post->table)->where('id',$post->id)->update(['active'=>0]);}
            return $query->first(); 
            
        }
    }
    static function deleteCourse($post){ return DB::table($post->table)->where('id',$post->id)->update(['status'=>0]); }

    static function getActivities($field,$ids, $regId=0){ 
        if($regId > 0){ $query  =   DB::table('registered_course_activities as RA')->select('A.*','G.group_id','G.activity_id')
                                    ->join('registered_courses as R','RA.reg_course_id','=','R.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                                    ->leftJoin('course_group_activities as G','A.id','=','G.activity_id')
                                    ->where('R.id',$regId)->whereIn('A.'.$field,$ids)->where('R.status',1)->where('A.status',1); 
        }else{$query            =   DB::table('course_acivities as A')->select('A.*','G.group_id','G.activity_id')
                                    ->leftJoin('course_group_activities as G','A.id','=','G.activity_id')->whereIn('A.'.$field,$ids)->where('A.status',1);
        }
        $data = $media          =   array();
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->groupName  = '';
            $resMedia           =   DB::table('course_acivity_media')->where('activity_id',$row->id)->get();
            if($resMedia){ foreach($resMedia as $val){ $media[] = $val;  } $row->media = $media; }else{ $row->media = array(); }
            if($row->group_id   >   0){ 
                $qry            =   DB::table('course_activity_groups as G')->join('course_group_activities as A','G.id','=','A.group_id')
                                    ->where('G.id',$row->group_id)->where('A.status',1)->where('G.status',1)->first();
                if($qry){$group = $qry->group_name; }else{ $group = 'ss'; } 
                $row->groupName =   $group;
            }
            $data[]             =   $row;
        } }
        return $data;
    }
    
    static function saveMilestone($post, $id){
        if($id      >   0){ DB::table('course_milestones')->where('id',$id)->update(['ms_name'=>$post->ms_name,'active'=>$post->active]); }
        else{ $id   =   DB::table('course_milestones')->insertGetId(['ms_name'=>$post->ms_name,'active'=>$post->active,'course_id'=>$post->cId]); }
        return $id;
    }
    
    static function saveActivity($post, $id){
        $data       =   ['ms_id'=>$post->ms_id,'course_id'=>$post->cId,'activity_name'=>$post->act_name,'activity_desc'=>$post->act_desc,'active'=>$post->active];
        if($id      >   0){ DB::table('course_acivities')->where('id',$id)->update($data); }
        else{ $id   =   DB::table('course_acivities')->insertGetId($data); DB::table('course_acivities')->where('id',$id)->update(['activity_code'=>'AV'.$id]); }
        return $id;
    }
    
    static function getActivityMedia($post){ return DB::table('course_acivity_media')->where('activity_id',$post->id)->where('status',1)->get(); }
    
    static function deleteMedia($post){ 
        $media                  =   DB::table($post->table)->where('id',$post->id)->first();
        if(DB::table($post->table)->where('id',$post->id)->delete()){ unlink(storage_path().$media->file); return 1; }else{ return 0; } 
    }

    static function getBadges(){ return DB::table('badges')->where('status',1)->get(); }
    
    static function getPendingApprovalCourses(){
        return DB::table('registered_courses as R')->select('C.*','R.id as regId','R.reg_status','R.registered_at','L.name as location','U.name','S.status_name')
                ->join('courses as C','R.course_id','=','C.id')->join('user_details as U','R.student_id','=','U.user_id')->join('cities as L','C.location','=','L.id')
                ->join('status_list as S','R.reg_status','=','S.id')->where('R.reg_status',0)->where('R.status',1)->get();
    }
    
    static function getUserById($id){ return  DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.id',$id)->first(); }
    
    static function getSessionRequests(){
        return DB::table('request_extra_activity_session as E')->select('E.*','A.activity_code','A.activity_name','S.name')
                ->join('registered_course_activities as RA','E.reg_activity_id','=','RA.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                ->join('user_details as S','E.student_id','=','S.user_id')
                ->where('E.status',1)->get();
    }
    
    static function getSessionRequest($id){
        $result     =   DB::table('request_extra_activity_session as E')->select('E.*','A.activity_code','A.activity_name','S.name','C.name as coach')
                        ->join('registered_course_activities as RA','E.reg_activity_id','=','RA.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                        ->join('user_details as S','E.student_id','=','S.user_id')->join('user_details as C','E.coach_id','=','C.user_id')
                        ->where('E.id',$id)->where('E.status',1)->first();
        if($result){ return $result; }else{ return false; }
    }
    
    static function updateSessionRequest($post){
        return DB::table('request_extra_activity_session')->where('id',$post['rId'])->update($post['gen']);
    }

    static function updateSessionStatus($post){
        $req                =   DB::table($post->table)->where('id',$post->id)->first();
        if($req){ 
            DB::table($post->table)->where('id',$post->id)->update([$post->field=>$post->status]);
            return array('type'=>'success','msg'=>'Request '.$post->status.' Successfully!');
        }else{ return array('type'=>'warning','msg'=>'Error occured. Please try after some time'); }
    }
}
