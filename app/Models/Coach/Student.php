<?php

namespace App\Models\Coach;

use Illuminate\Database\Eloquent\Model;
use DB;
use Session;

class Student extends Model {
    static function students($userId){
        $where                  =   [['R.coach_id','=',$userId],['R.active','=',1],['R.status','=',1],['U.user_type','=',2],['U.is_parent','=',0],['U.status','=',1]];
        $query                  =   DB::table('users as U')->select('U.*','D.*')->join('user_details as D','U.id','=','D.user_id')->join('registered_courses as R','U.id','=','R.student_id')
                                    ->where($where)->groupBy('R.student_id');
        if($query->count()      >   0){ foreach($query->get() as $row){
            if($row->is_parent  ==  0){ $row->parent_name   =   Student::getParentName($row->parent); }else{ $row->parent_name = 'Nill'; }
            $row->reg_courses   =   DB::table('registered_courses')->where('student_id',$row->user_id)->where('coach_id',$userId)->where('status',1)->count();
            $data[]             =   $row;
        } }
        return $data;
    }
    
    static function student($userId,$id){
        $where                  =   [['R.coach_id','=',$userId],['U.id','=',$id],['R.active','=',1],['R.status','=',1],['U.user_type','=',2],['U.status','=',1]];
        return DB::table('users as U')->select('U.*','D.*')->join('user_details as D','U.id','=','D.user_id')->join('registered_courses as R','U.id','=','R.student_id')
                ->where($where)->first();
    }
    
    static function getParentName($id){
        $query                  =   DB::table('user_details')->where('user_id',$id);
        if($query->count()      >   0){ return $query->first()->name; }else{ return 'Nill'; }
    }
    
    static function getRegCoursesByStudentId($userId,$studentId){
        $data                   =   [];
        $query                  =   DB::table('registered_courses as R')->select('R.*','C.*','R.id as regId')->join('courses as C','R.course_id','=','C.id')
                                    ->where('R.student_id',$studentId)->where('R.coach_id',$userId)->where('R.active',1)->where('R.status',1);
        if($query->count()      >   0){ foreach($query->get() as $row){
            $row->complete      =   DB::table('registered_course_activities')->where('reg_course_id',$row->regId)->where('curr_status',3)->where('status',1)->count();
            $row->process       =   DB::table('registered_course_activities')->where('reg_course_id',$row->regId)->where('curr_status',2)->where('status',1)->count();
            $row->pending       =   DB::table('registered_course_activities')->where('reg_course_id',$row->regId)->where('curr_status',0)->where('status',1)->count();
            $data[]             =   $row;
        } return $data; }else{ return false; }
    }
    
    static function updateCoursePercent($post){ return DB::table('registered_courses')->where('id',$post->id)->update(['complete_percent'=>$post->percent]); }
}
