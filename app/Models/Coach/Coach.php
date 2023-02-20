<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;
class Coach extends Model
{
     static function getTotalStudents($userId)
      {
        return DB::table('registered_courses')->where('coach_id',$userId)->groupBy('student_id')->count();
        
      }   
    static function getTotalCourses($courseId)
      {
        
        return DB::table('registered_courses')->where('coach_id',$courseId)->groupBy('course_id')->count();

      }   

    static function getCompletedTask($taskId)
      {
        return DB::table('registered_courses as R')->join('registered_course_activities as A', 'R.id', '=', 'A.reg_course_id')->where('R.coach_id',$taskId)->where('A.curr_status','=',3)->where('A.status','=',1)->count();
      }
    static function getPendingTask($pendingId)
      {
        return DB::table('registered_courses as R')->join('registered_course_activities as A', 'R.id', '=', 'A.reg_course_id')->where('R.coach_id',$pendingId)->whereIn('A.curr_status',[0,1,2])->where('A.status','=',1)->count();
      }
        static function getProfile($uid)
      { 
        return DB::table('users as U')->join('user_details as D','D.user_id','=','U.id')->where('U.id', $uid)->first();
      }

    static function updateProfile($data, $userid) {
        DB::beginTransaction();
        try {
            DB::table('users as U')->join('user_details as D','D.user_id','=','U.id')->where('U.id', $uid)->update($data);
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback(); return false;
        }
    }

    
}
