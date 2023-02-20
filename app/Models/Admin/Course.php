<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

namespace App\Models\Admin;

use App\Models\Functions;
use DB;

class Course extends User {

    static function getCourses() { 
        return DB::table('courses as C')->select('C.*','L.name as location','U.name')
                ->join('cities as L','C.location','=','L.id')->join('user_details as U','C.coach','=','U.user_id')->where('C.status',1)->get();
    }
    
    static function getCourse($id){
        $query                  =   DB::table('courses as C')->select('C.*','L.name as locName')->join('cities as L','C.location','=','L.id')->where('C.id',$id);
        $course                 =   $query->first();
        $data['course']         =   $courseLocs = $coursecoaches = array();
        if($query->count()       >   0){
            $course->media      =   DB::table('course_media')->where('course_id',$id)->where('active',1)->where('status',1)->get();
            $mStones            =   DB::table('course_milestones')->where([['course_id','=',$id]])->get();
            if($mStones){ foreach($mStones as $mStone){
                $mStone->activities =   Course::getActivities('ms_id',[$mStone->id]);
                $data['mStone'][]   =   $mStone;
            } }
        }
        $locations              =   DB::table('cities')->where('active',1)->where('status',1)->get();
        $coaches                =   DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('user_type',1)->where('U.active',1)->where('U.status',1)->get();
        if($locations){ foreach($locations as $row){ $courseLocs[$row->id] = $row->name; } }
        if($coaches){ foreach($coaches as $row){ $coursecoaches[$row->user_id] = $row->name; } }
        $data['locations']      =   $courseLocs;
        $data['coaches']        =   $coursecoaches;
        $data['course']         =   $course;
        return (object)$data;
    }
    
    static function getCourseMedias($courseId){ return DB::table('course_media')->where('course_id',$courseId)->where('status',1)->get(); }

    static function getMilestoneDetails($courseId){
        $query                  =   DB::table('course_milestones')->where('course_id',$courseId)->where('status',1);
        if($query->count()      >   0){$data = array(); foreach($query->get() as $row){
            $row->activities    =   Course::getActivities('ms_id',[$row->id]);
            $row->groups        =   Course::getGroupDetails($row->id);
            $data[]             =   $row;
        } }else{ return false; }
        return $data;
    }
    
    static function getGroupDetails($msId){
        $query                  =   DB::table('course_activity_groups')->where('ms_id',$msId)->where('status',1);
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

    static function saveCourse($post,$id){ 
        $course                 =   $post->gen; 
        $notify                 =   true;
        if($id > 0){ $crs       =   DB::table('courses')->where('id',$id)->first(); if($crs->location == $course['location']){ $notify = false; } }
        if($id                  >   0){ DB::table('courses')->where('id',$id)->update($course); $courseId = $id; }
        else{ 
            $courseId         =   DB::table('courses')->insertGetId($course); DB::table('courses')->where('id',$courseId)->update(['course_code'=>'SC-'.$courseId]); 
            mkdir(storage_path() . '/app/public/Courses/'.$courseId,0755,TRUE); 
            $courseId; 
        }
        if($courseId){
            if($notify == true){
                $locData            =   DB::table('cities')->where('id',$course['location'])->first();
                if($locData){           $locName = $locData->name; }else{ $locName = 'New location'; }
                $students           =   Course::getNotifyLogStudents($course['location']);
                $notifyParms        =   ['course_id'=>$courseId,'location'=>$course['location']];
                $type               =   'new_course'; $title = 'New Course'; $msg = 'New course has been launched at '.$locName;
                if($students){ foreach($students as $student){
                    $pushNotify     =   $student->push_notify; $pushNotify++; 
                    Functions::addNotification(0,$student->user_id,$courseId,$type,$msg,$title);
                    Functions::pushNotify($title,$msg,$student->deviceToken,$pushNotify,$type,$notifyParms,$student->os);
                    Functions::updateNotifyCount($student->user_id,$pushNotify,'push_notify');
                } }
            }
            return $courseId;
        }
    }
    
    static function uploadMedia($post){
        $data                   =   [$post->field_id=>$post->cId,'file'=>$post->path.$post->file,'type'=>$post->type,'active'=>1];
        $insId                  =   DB::table($post->table)->insertGetId($data);
        if($insId){ echo $insId; }else{ echo 0; } 
    }

    static function updateStatus($post){ return DB::table($post->table)->where('id',$post->id)->update(['active'=>$post->active]); }
    static function deleteCourse($post){ return DB::table($post->table)->where('id',$post->id)->update(['status'=>0]); }

    static function getActivities($field='ms_id',$msId){
        $query                  =   DB::table('course_acivities as A')->select('A.*','G.group_id','G.activity_id')
                                    ->leftJoin('course_group_activities as G','A.id','=','G.activity_id')->whereIn('A.'.$field,$msId)->where('A.status',1);
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
    
    static function getAssActivities($msId,$grId,$assigned){
        if($assigned == 0){
            $actIds             =   [0];
            $query              =   DB::table('course_group_activities')->where('ms_id',$msId)->where('status',1);
            if($query->count()  >   0){ foreach($query->get() as $row){ $actIds[] = $row->activity_id; } }
            $query              =   DB::table('course_acivities')
                                    ->where('ms_id',$msId)->where('status',1)->whereNotIn('id',$actIds);
        }else{
            $query              =   DB::table('course_acivities as A')->join('course_group_activities as G','A.id','=','G.activity_id')
                                    ->where('G.group_id',$grId)->where('A.status',1)->where('G.status',1);
        }
        if($query->count()      >   0){ return $query->get(); }else{ return array(); }
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

    static function getPendingApprovalCourses(){
        $query                  =   DB::table('registered_courses as R')->select('R.*','C.coures_code','C.coures_name','L.name as location','D.name as coach','U.name as student')
                                    ->join('courses as C','R.course_id','=','C.id')->join('cities as L','C.location','=','L.id')
                                    ->join('user_details as D','C.coach','=','D.user_id')->join('user_details as U','R.student_id','=','U.user_id')
                                    ->where('R.reg_status',0)->where('R.status',1)->get();
    }
    
    static function saveGroup($post,$id,$activities){
        $post['activity_ids']   =   implode(',',$activities);
        if($id > 0){ DB::table('course_activity_groups')->where('id',$id)->update($post); return $id; }
        else{ return DB::table('course_activity_groups')->insertGetId($post); }
    }
    
    static function deleteGroup($post){
        DB::table($post->table)->where('id',$post->id)->delete(); DB::table('course_group_activities')->where('group_id',$post->id)->delete();
    }

        static function updateGroupActivities($data,$msId,$grId){
        DB::table('course_group_activities')->where('group_id',$grId)->delete();
        if(count($data) > 0){ foreach($data as $row){
            DB::table('course_group_activities')->insert(['ms_id'=>$msId,'group_id'=>$grId,'activity_id'=>$row]);
        } }
    }
    
    static function getNotifyLogStudents($location){
        $query                  =   DB::table('location_notify_log as L')->select('U.*','D.*')
                                    ->join('users as U','L.user_id','=','U.id')->join('user_details as D','U.id','=','D.user_id')
                                    ->where('L.location_id',$location)->where('L.status',1)->where('U.status',1)->where('U.active',1);
        if($query->count()      >   0){ return $query->get(); }else{ return false; }
    }

    

    static function getBadges(){ return DB::table('badges')->where('status',1)->get(); }
    
    static function saveBadge($post,$file){
        $query                  =   DB::table('badges')->where('title',$post->title);
        if($query->count()      >   0){
            $badge              =   $query->first();
            if($badge->status   ==  0){
                $query          =   DB::table('badges')->where('title',$post->title)->where('id','!=',$post->bid)->where('status',1);
                if($query->count()  >   0){ return 'exist'; }
                else{ if($post->bid == 0){ $post->bid = $badge->id; DB::table('badges')->where('id',$badge->id)->update(['status'=>1]); } }
            }else{ if($badge->id    != $post->bid){ return 'exist'; } }
        }
        $data                   =   ['title'=>$post->title,'description'=>$post->description,'active'=>$post->active];
        if(isset($file->badgeImg)){
            $extn               =   $file->badgeImg->getClientOriginalExtension();
            if($file->badgeImg->move(storage_path() . '/app/public/Courses/Badges/',$post->title.'.'.$extn)){
                $data['badge_img']  =   '/app/public/Courses/Badges/'. $post->title.'.'.$extn;
            } 
        }
        if($post->bid > 0){         DB::table('badges')->where('id',$post->bid)->update($data); $res = $post->bid; }
        else{ $res              =   DB::table('badges')->insertGetId($data); } return 'success';
    }
}
