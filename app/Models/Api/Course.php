<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Functions;
use App\Models\Email;
use DB;

class Course extends Model
{
    static function getCourses($user,$location=0,$childId=0){
        $result                 =   array();
        if($childId > 0){ 
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ $user   =   $query->first(); }else{
                return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.']));
            }
        }
        $where                  =   [['C.active','=',1],['C.status','=',1]];
        if($location            >   0){ $where[] = ['C.location','=',$location]; }
        $query                  =   DB::table('courses as C')->select('C.*','L.name as locName','U.name as CoachName')
                                    ->join('cities as L','C.location','=','L.id')->join('user_details as U','C.coach','=','U.user_id')
                                    ->where($where);
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->registered    =   Course::isRegistered($user->id,$row->id);
            $row->media         =   Course::getCourseDefaultMedia($row->id);
            $row->milestones    =   DB::table('course_milestones')->where('course_id',$row->id)->where('active',1)->where('status',1)->count();
            $row->avtGroups     =   DB::table('course_activity_groups')->where('course_id',$row->id)->where('active',1)->where('status',1)->count();
            $row->activities    =   Course::getActivityCount($row->id);
            $result[]           =   $row;
        } }
        $location               =   DB::table('cities')->where('id',$location)->first();
        $location->notified     =   Course::getLocationNotifiedFlag($user->id,$location->id);
        return array('status'=>'success','message'=>'Course List','data'=>['location'=>$location,'course_list'=>$result]);
    }
    
    static function getCourseDefaultMedia($cId){
        $data                   =   array('file'=>url('/storage/app/public/no_image.jpg'),'type'=>'image');
        $media                  =   DB::table('course_media')->where('course_id',$cId)->where('active',1)->where('status',1)->first();
        if($media){ $data       =   ['file'=>url('/storage'.$media->file),'type'=>$media->type]; }
        return $data;
    }
    
    static function getLocations($search='',$userId=0){
        $where                  =   [['S.country_id','=',132],['C.status','=',1]];
        if($search              !=  ''){ $where[]   =   ['C.name','like','%'.$search.'%']; }
        $query                  =   DB::table('cities as C')->select('C.*','S.name as stName,S.id as stId')->join('states as S','C.state_id','=','S.id')->where($where);
        if($query->count()      >   0){ foreach($query->get() as $row){
            $data['id']         =   $row->id; $data['locName']  =   $row->name; $result[] = $data;
        } }else{ $result = array(); }
        $userData               =   Course::getUserDetails($userId);
        if($userData){              $usr['push_notify'] =   $userData->push_notify; $usr['chat_notify'] = $userData->chat_notify ; }
        else{                       $usr['push_notify'] =   $usr['chat_notify'] = 0;  }
        
        return array('status'=>'success','message'=>'Location List','data'=>['location_list'=>$result,'userData'=>$usr]);
    }
    
    static function getLocationNotifiedFlag($userId,$locId){
        if(DB::table('location_notify_log')->where('user_id',$userId)->where('location_id',$locId)->count() >0){ return 1; }else{ return 0; }
    }

    static function saveNotifyLog($user,$locId){
        $query                  =   DB::table('location_notify_log')->where('user_id',$user->id)->where('location_id',$locId)->where('status',1);
        if($query->count()      >   0){ return array('status'=>'success','message'=>'Already Notified','data'=>['message'=>'Already Notified']); }
        else{
            if(DB::table('cities')->where('id',$locId)->count() > 0){
                DB::table('location_notify_log')->insert(['user_id'=>$user->id,'location_id'=>$locId,'created_at'=>date('Y-m-d H:i:s')]);
                return array('status'=>'success','message'=>'Notified Successfully','data'=>['message'=>'Notified Successfully']);
            }else{ return array('status'=>'error','message'=>'Invalid Location','data'=>array('errors' =>['message'=>'Invalid Location.'])); }
        }
    }

    static function getCourseDetail($user,$id,$childId=0){
        if($childId > 0){ 
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ $user   =   $query->first(); }else{
                return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.']));
            }
        }
        $query                  =   DB::table('courses as C')->select('C.*','L.name as locName','U.name as coachName')
                                    ->join('cities as L','C.location','=','L.id')->join('user_details as U','C.coach','=','U.user_id')->where('C.id',$id);
        $course                 =   $query->first();
        $course->registered     =   Course::isRegistered($user->id,$course->id);
        $data['mStone']         =   $data['course'] = array();
        if($query->count()       >   0){
            $course->media      =   Course::getCourseMedia($id);
            $data['course']     =   $course;
            $mStones            =   DB::table('course_milestones')->where([['course_id','=',$id],['active','=',1],['status','=',1]])->get();
            if($mStones){ foreach($mStones as $mStone){
                $mStone->avtGroups  =   Course::getActivyGroups($mStone->id);
                $mStone->activities =   Course::getActivities($mStone->id);
                $data['mStone'][]   =   $mStone;
            } }
        }
        return array('status'=>'success','message'=>'Location List','data'=>$data);
    }
    
    static function getCourseMedia($id){
        $query                  =   DB::table('course_media')->where('course_id',$id)->where('active',1)->where('status',1);
        if($query->count()      >   0){ foreach($query->get() as $row){ $row->file = url('/storage'.$row->file); $data[] = $row; } }else{ $data = array(); }
        return $data;
    }

    static function getActivities($msId,$type=''){
        $query                  =   DB::table('course_activity_groups')->where('ms_id',$msId)->where('active',1)->where('status',1);
        $avtIds                 =   '0';
        if($query->count()      >   0){ foreach($query->get() as $row){ $avtIds =   $avtIds.','.$row->activity_ids; } }
        $query                  =   DB::table('course_acivities')->where('ms_id',$msId)->whereNotIn('id',explode(',',$avtIds))->where('active',1)->where('status',1);
        $data = $media          =   array();
        if($query->count()      >   0){ foreach($query->get() as $row){
            $resMedia           =   DB::table('course_acivity_media')->where('activity_id',$row->id)->get();  $media = array();
            if($resMedia){ foreach($resMedia as $val){ $val->file = url('/storage'.$val->file); $media[] = $val;  } $row->media = $media; }else{ $row->media = array(); }
            $data[]             =   $row;
        } }
        return $data;
    }
    
    static function getActivityCount($cId){
        $query                  =   DB::table('course_activity_groups')->where('course_id',$cId)->where('active',1)->where('status',1);
        $avtIds                 =   '0';
        if($query->count()      >   0){ 
            foreach($query->get()   as $row){ $avtIds         =   $avtIds.','.$row->activity_ids; } 
            return DB::table('course_acivities')->where('course_id',$cId)->whereNotIn('id',explode(',',$avtIds))->where('active',1)->where('status',1)->count(); 
        }else{  return DB::table('course_acivities')->where('course_id',$cId)->where('active',1)->where('status',1)->count(); }
    }
    
    static function getActivyGroups($mId){
        $query                  =   DB::table('course_activity_groups')->where('ms_id',$mId)->where('active',1)->where('status',1);
        $result                 =   $data   =   array(); $avtIds    =   '0';
        if($query->count()      >   0){ foreach($query->get() as $row){ 
            $avtIds             =   $row->activity_ids;
            $group              =    $row;   
            $qry                =   DB::table('course_acivities')->whereIn('id',explode(',',$avtIds))->where('active',1)->where('status',1); 
            if($qry->count()    >   0){ $data = array(); foreach($qry->get() as $row){
                $resMedia           =   DB::table('course_acivity_media')->where('activity_id',$row->id)->get();
                if($resMedia){ foreach($resMedia as $val){ $val->file = url('/storage'.$val->file); $media[] = $val;  } $row->media = $media; }else{ $row->media = array(); }
                $data[]         =   $row;
            }}
            $group->activities  =   $data;
            $result[]           =   $group;
         } } return $result;
    }
    
    static function isRegistered($userId, $cId){
        $query                  =   DB::table('registered_courses')->where([['student_id','=',$userId],['course_id','=',$cId],['active','=',1],['status','=',1]]);
        if($query->count()      >   0){ if($query->first()->reg_status == 0){ return 2; } return 1; }else{ return 0; }
    }

    static function getBadgeList(){ 
        $query                  =   DB::table('badges')->where('status',1);
        if($query->count()      >   0){ foreach($query->get() as $row){ $row->badge_img = url('/storage'.$row->badge_img); $data[] = $row; }}else{ $data = null; }
        return array('status'=>'success','message'=>'Location List','data'=>['badge_list'=>$data]);
    }
    
    static function registerCourse($user,$child,$cId){
        if($user->is_parent     ==  1 && $child == 0){
            return array('status'=>'error','message'=>'Permission Denyed','data'=>array('errors' =>['parent'=>'Parent cannot add course myself.']));
        }
        $query                  =   DB::table('users')->where('id',$child)->where('parent',$user->id)->where('active',1)->where('status',1);
        if($query->count()      >   0){ $userId = $query->first()->id; }else{ $userId = $user->id; }
        if(Course::isRegistered($userId,$cId) == 1){
            return array('status'=>'error','message'=>'Already Registered','data'=>array('errors' =>['registered'=>'This course already registered.']));
        }
        $course                 =   DB::table('courses')->where('id',$cId)->first();
        $activities             =   DB::table('course_acivities')->where('course_id',$cId)->where('active',1)->where('status',1)->get();
        $regId                  =   DB::table('registered_courses')->insertGetId(['student_id'=>$userId,'course_id'=>$cId,'coach_id'=>$course->coach]);
        if($regId){ 
            if($activities){ foreach($activities as $row){
                $data           =   ['reg_course_id'=>$regId,'course_id'=>$row->course_id,'ms_id'=>$row->ms_id,'activity_id'=>$row->id];
                DB::table('registered_course_activities')->insertGetId($data);
            } }
            return array('status'=>'success','message'=>'Course Registered','data'=>['registered'=>'Course registered successfully and awaiting for admin approval']); 
        }else{ return array('status'=>'error','message'=>'Course Registration Failed','data'=>array('errors' =>['failed'=>'Course Registration Failed.'])); }
    }
    
    static function getMyCourses($userId,$parent,$child=0){
        if($parent     ==  1 && $child == 0){
            return array('status'=>'error','message'=>'Child id field is required','data'=>array('errors' =>['error1'=>'Child id field is required.']));
        }
        if($child > 0){
            $query              =   DB::table('users')->where('id',$child)->where('parent',$userId)->where('active',1)->where('status',1);
        }else{ $query           =   DB::table('users')->where('id',$userId); }
        if($query->count()      >   0){ $user   =   $query->first(); }
        else{ return array('status'=>'error','message'=>'Invalid Child ID','data'=>array('errors' =>['failed'=>'Invalid Child ID.'])); }
        $result                 =   $data = array();
        $query                  =   DB::table('registered_courses as R')->select('R.*','C.course_code','C.course_name','L.name as location','D.name as coach','U.name as student')
                                    ->join('courses as C','R.course_id','=','C.id')->join('cities as L','C.location','=','L.id')
                                    ->join('user_details as D','C.coach','=','D.user_id')->join('user_details as U','R.student_id','=','U.user_id')
                                    ->where('R.student_id',$user->id)->where('R.reg_status',1)->where('R.active',1)->where('R.status',1);
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->milestoneData =   Course::getMilestones($row->id);
            $data[]             =   $row;
        } }
        $userData               =   Course::getUserDetails($userId);
        $usr['push_notify']     =   $userData->push_notify;
        $usr['chat_notify']     =   $userData->chat_notify ;
        return array('status'=>'success','message'=>'My Courses','data'=>['course_list'=>$data,'userData'=>$usr]);
    }
    
    static function getMilestones($cId){
        $data = $msIds          =   array(); $cms = 0; $table = 'registered_course_activities';
        $query                  =   DB::table($table)->where('reg_course_id',$cId)->where('status',1);
        if($query->count()      >   0){ 
            foreach($query->get()   as $row){ $msIds[$row->ms_id] =   $row->ms_id; } 
            foreach($msIds      as  $msId){ if(DB::table($table)->where([['curr_status','!=',3],['reg_course_id','=',$cId],['ms_id','=',$msId],['status','=',1]])->count() == 0) $cms++; }
            $data['all']        =   count($msIds);  $data['complete'] = $cms;
        }else{ $data['all']     =   $data['complete'] =  0; }
        $query                  =   DB::table('course_milestones')->whereIn('id',$msIds);
        $msNames                =   '';
        if($query->count()      >   0){ foreach($query->get() as $row){ $names[] = $row->ms_name; } $msNames = implode(', ',$names); }
        $data['names']          =   $msNames;
        return $data;
    }
    
    static function getMyActivities($userId,$parent,$child=0,$post){
        if($parent     ==  1 && $child == 0){
            return array('status'=>'error','message'=>'Child id field is required','data'=>array('errors' =>['error1'=>'Child id field is required.']));
        }
        if($child > 0){
            $query              =   DB::table('users')->where('id',$child)->where('parent',$userId)->where('active',1)->where('status',1);
        }else{ $query           =   DB::table('users')->where('id',$userId); }
        if($query->count()      >   0){ $user   =   $query->first(); }
        else{ return array('status'=>'error','message'=>'Invalid Child ID','data'=>array('errors' =>['failed'=>'Invalid Child ID.'])); }
        if(DB::table('registered_courses')->where('id',$post->course_id)->where('student_id',$user->id)->where('status',1)->count() == 0){
            return array('status'=>'error','message'=>'Invalid Course ID','data'=>array('errors' =>['error1'=>'Invalid course ID.']));
        }
        $data['milestoneData']  =   Course::getMilestones($post->course_id);
        $data['activities']     =   Course::getRegActivities($post->course_id);
        $userData               =   Course::getUserDetails($userId);
        $usr['push_notify']     =   $userData->push_notify;
        $usr['chat_notify']     =   $userData->chat_notify ;
        $data['userData']       =   $usr;
        return array('status'=>'success','message'=>'My Courses','data'=>$data);
    }
    
    static function getRegActivities($cId){
        $actTypes               =   ['upcoming'=>0,'inprogress'=>2,'complete'=>3,'rejected'=>4];
        $result = $data         =   array();
        foreach($actTypes       as  $k=>$type){ 
            $data               =   array();
            $query              =   DB::table('registered_course_activities as R')->select('R.*','A.activity_code','A.activity_name','A.activity_desc')
                                    ->join('course_acivities as A','R.activity_id','=','A.id')->where('R.reg_course_id',$cId)->where('R.curr_status',$type)->where('R.status',1);
            if($query->count()  >   0){foreach($query->get() as $row){
                $row->media     =   Course::getActivityMedia('course_acivity_media','activity_id',$row->activity_id);
                if($type        ==  3){ 
                    $badge      =   DB::table('badges')->where('id',$row->badge_id)->first();
                    if($badge){     $row->badge = url('/storage'.$badge->badge_img); }else{ $row->badge = url('/storage/app/public/no_image.jpg'); }
                }
                $data[]         =   $row;
            } $result[$k]       =   $data; }else{ $result[$k]=   array(); }
        }
        return $result;
    }
    
    static function getActivityMedia($table,$field,$actId){
        $query                  =   DB::table($table)->where($field,$actId)->where('status',1);
        $data                   =   array();
        if($query->count()      >   0){ foreach($query->get() as $row){ $row->file  =   url('/storage'.$row->file); $data[] = $row; } }
        return $data;
    }
    
    static function getActivityDetail($user,$childId,$post){
        if($user->is_parent     ==  1 && $childId == 0){
            return array('status'=>'error','message'=>'Child id field is required','data'=>array('errors' =>['error1'=>'Child id field is required.']));
        }
        if($childId > 0){ 
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ $user   =   $query->first(); }else{
                return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.']));
            }
        }
        $data                   =   array();
        $query                  =   DB::table('registered_course_activities as RA')->select('A.*')
                                    ->join('registered_courses as R','RA.reg_course_id','=','R.id')->join('course_acivities as A','RA.activity_id','=','A.id')
                                    ->where('RA.id',$post->activity_id)->where('R.student_id',$user->id)->where('RA.status',1);
        if($query->count()      >   0){ 
            $activity           =   $query->first();
            $activity->media    =   Course::getActivityMedia('course_acivity_media','activity_id',$activity->id);
            $data['detail']     =   $activity;
        }else{ $data['detail'] =   array(); }
        $whereIn                =   [1]; if(isset($post->temp) && $post->temp == 1){ $whereIn[] = 10; }
        $query                  =   DB::table('submited_activities as S')->select('S.*')->join('registered_courses as R','S.reg_course_id','=','R.id')
                                    ->where('S.reg_activity_id',$post->activity_id)->where('R.student_id',$user->id)->whereIn('S.status',$whereIn);
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->media         =   Course::getActivityMedia('submited_activity_media','submit_id',$row->id);
            $badge              =   DB::table('badges')->where('id',$row->badge_id)->where('status',1)->first();
            if($badge){             $badge->badge_img = url('/storage'.$badge->badge_img); $row->badge =  $badge; }else{ $row->badge = null; }
            $data['submited'][] =   $row;
        }}else{ $data['submited']=   array(); }
         return array('status'=>'success','message'=>'Activity Detail','data'=>$data);
    }
    
    static function submitActivity($user, $childId, $post){
        $userId                 =   $user->id;
        if($user->is_parent     ==  1 && $childId == 0){
            return array('status'=>'error','message'=>'Child id field is required','data'=>array('errors' =>['error1'=>'Child id field is required.']));
        }
        if($childId > 0){ 
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ $user   =   $query->first(); }else{
                return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.']));
            }
        }
        $act                     =   DB::table('registered_course_activities as A')->select('A.*','C.coach_id')->join('registered_courses as C','A.reg_course_id','=','C.id')
                                    ->where('A.id',$post->activity_id)->where('C.student_id',$user->id)->where('A.status',1)->where('C.status',1)->first();
        if($act){
            $validSubmit        =   Course::checkSubmitActStatus($user,$act);
            if($validSubmit->status == false){ 
                return      array('status'=>'error','message'=>$validSubmit->msg,'data'=>array('errors' =>['error1'=>$validSubmit->msg])); 
            }
            $where              =   [['student_id','=',$user->id],['reg_course_id','=',$act->reg_course_id],['reg_activity_id','=',$act->id],['act_status','=',0]];
            $data               =   ['student_id'=>$user->id,'reg_course_id'=>$act->reg_course_id,'reg_activity_id'=>$act->id,'description'=>$post->description,'submited_at'=>date('Y-m-d H:i:s'),'act_status'=>1,'status'=>1];
            $query              =   DB::table('submited_activities')->whereIn('status',[1,10])->where($where)->orderBy('id','desc');
            if($query->count()  >   0){ $submitId = $query->first()->id; DB::table('submited_activities')->where('id',$submitId)->update($data); }
            else{ $submitId     =   DB::table('submited_activities')->insertGetId($data); }
            DB::table('registered_course_activities')->where('id',$act->id)->update(['curr_status'=>2]);
            $User               =   DB::table('user_details')->where('user_id',$userId)->first();
            $msg                =   $User->name.' has been submited activity';
            Functions::addNotification($userId,$act->coach_id,$submitId,'activity_submited',$msg,'Activity Submited');
            return array('status'=>'success','message'=>'Submitted Successfully!','data'=>['message'=>'Course submited successfully!']);
        }else{ return array('status'=>'error','message'=>'Invalid activity ID','data'=>array('errors' =>['error1'=>'Invalid activity ID.'])); }
    }
    
    static function submitActivityMedia($user, $childId, $post,$file){
     //   return array('status'=>'success','message'=>'Submitted Successfully!','data'=>$file->getClientOriginalName());
        if($user->is_parent     ==  1 && $childId == 0){
            return array('status'=>'error','message'=>'Child id field is required','data'=>array('errors' =>['error1'=>'Child id field is required.']));
        }
        if($childId > 0){ 
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ $user   =   $query->first(); }else{
                return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.']));
            }
        }
        $act                     =   DB::table('registered_course_activities as A')->select('A.*')->join('registered_courses as C','A.reg_course_id','=','C.id')
                                    ->where('A.id',$post->activity_id)->where('C.student_id',$user->id)->where('A.status',1)->where('C.status',1)->first();
        if($act){
            $validSubmit        =   Course::checkSubmitActStatus($user,$act);
            if($validSubmit->status == false){ 
                return      array('status'=>'error','message'=>$validSubmit->msg,'data'=>array('errors' =>['error1'=>$validSubmit->msg])); 
            }
            $where              =   [['student_id','=',$user->id],['reg_course_id','=',$act->reg_course_id],['reg_activity_id','=',$act->id],['act_status','=',0]];
            $data               =   ['student_id'=>$user->id,'reg_course_id'=>$act->reg_course_id,'reg_activity_id'=>$act->id,'status'=>10];
            $query              =   DB::table('submited_activities')->whereIn('status',[1,10])->where($where)->orderBy('id','desc');
            if($query->count()  >   0){ $submitId   =   $query->first()->id; }else{ $submitId   =   DB::table('submited_activities')->insertGetId($data); }
            $extn               =   $file->getClientOriginalExtension();
            $fileName           =   time().'.'.$extn;
            if($extn == 'jpg'   ||  $extn == 'jpeg' || $extn == 'png'){ $fileType = 'image'; }else if($extn == 'mp4'){ $fileType = 'video'; }else{ $fileType = ''; }
            if(isset($post->description)){ $desc = $post->description; }else{ $desc = ''; }
            if($file->move(storage_path() . '/app/public/Activities/Submited/'.$submitId.'/', $fileName)){
                $fileName       =   '/app/public/Activities/Submited/'.$submitId.'/'. $fileName;
                $mediaId        =   DB::table('submited_activity_media')->insertGetId(['submit_id'=>$submitId,'description'=>$desc,'file'=>$fileName,'type'=>$fileType]);
                if($mediaId){ return array('status'=>'success','message'=>'Submitted Successfully!','data'=>['media_id'=>$mediaId]); }
                else{ return array('status'=>'error','message'=>'Submission Failed','data'=>array('errors' =>['error1'=>'Media submission failed.'])); }
            }else{ return array('status'=>'error','message'=>'Upload Failed','data'=>array('errors' =>['error1'=>'Media upload failed.'])); }
        }else{ return array('status'=>'error','message'=>'Invalid activity ID','data'=>array('errors' =>['error1'=>'Invalid activity ID.'])); }
    }
    
    static function checkSubmitActStatus($user,$act){
        if(DB::table('submited_activities as S')->where([['student_id','=',$user->id],['reg_course_id','=',$act->reg_course_id],['reg_activity_id','=',$act->id],['status','=',1]])->count() == 0){
            $res['status'] = true; $res['msg'] = ''; return (object) $res;
        }
        $where              =   [['S.student_id','=',$user->id],['S.reg_course_id','=',$act->reg_course_id],['S.reg_activity_id','=',$act->id],['S.act_status','>',0],['S.status','=',1]];
        $query              =   DB::table('submited_activities as S')->join('registered_course_activities as R','S.reg_activity_id','=','R.id')->where($where);
        if($query->count()  >   0){
            if($query->first()->curr_status == 2){ $res['status'] = false; $res['msg'] = 'Previously submited activity is Inprogress.'; }else{ $res['status'] = true; $res['msg'] = ''; }
        }else{ $res['status'] = false; $res['msg'] = 'Invalid activity ID'; } 
        return (object) $res;
    }

    static function deleteMedia($user, $post){
        $query                  =   DB::table('submited_activity_media')->where('id',$post->media_id);
        if($query->count()      >   0){ $media = $query->first(); }
        else{ return array('status'=>'error','message'=>'Invalid media ID','data'=>array('errors' =>['error1'=>'Invalid media ID'])); }
        $delete                 =   DB::table('submited_activity_media')->where('id',$post->media_id)->delete();
        if($delete){                unlink(storage_path().$media->file);
            return array('status'=>'success','message'=>'Media Deleted Successfully!','data'=>['message'=>'Media Deleted Successfully!']);
        }else{ return array('status'=>'error','message'=>'Media falied to delete','data'=>array('errors' =>['error1'=>'Media falied to delete'])); }
    }
    
    
    static function getUserDetails($id){
        $query                  =   DB::table('users as U')->select('U.*','D.user_id','D.name','D.avthar','R.relation as relName')
                                    ->join('user_details as D','U.id','=','D.user_id')->leftJoin('relationships as R','U.relation','=','R.id')->where('U.id',$id);
        $user                   =   array();
        if($query->count()      >   0){
            $user               =   $query->first();
            $course             =   User::registeredCourses($user->user_id);
            $user->registered   =   $course->registered;
            $user->approved     =   $course->approved;
            unset($user->otp);      unset($user->password); unset($user->otp_sent_at); unset($user->remember_token); unset($user->email_verified_at); 
            unset($user->access_token); 
            if($user->avthar    !=  NULL || $user->avthar != ''){ $user->avthar = url('/storage'.$user->avthar); }else{ $user->avthar = url('/storage/app/public/user.png'); }
        }
        return $user;
    }
}
