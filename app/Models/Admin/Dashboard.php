<?php

namespace App\Models\Admin;

use DB; 

class Dashboard extends User {

    static function getDashboardData(){
        $data['totalStudents']      =   DB::table('users')->where([['user_type','=',2],['is_parent','=',0],['status','=',1]])->count();

        $data['totalCoaches']       =   DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where([['U.user_type','=',1],['U.status','=',1]])->count();
        $data['totalCourses']       =   DB::table('courses')->where([['status','=',1]])->count();
        $data['activeCourses']      =   DB::table('courses')->where([['active','=',1],['status','=',1]])->count();
        return (object) $data;
    }
    static function getDashboardDetail()
    {
        return DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->leftJoin('cities as C','C.id','=','D.city')->select('D.*','U.*','C.name as location')->where('U.user_type',1)->where('U.status',1)->latest()->take(5)->get();
    }

    static function getLocations(){
       $query              =   DB::table('cities')->where('status',1);
       $data               =   array();
       if($query->count()  >   0){ foreach($query->get() as $row){ $data[$row->id] = $row->name; } }
       return $data;
    }

    static function getProfile($uid)
     { return DB::table('admins as A')->select('A.*','R.role_name')->join('admin_role as R','A.role','=','R.id')->where('A.id', $uid)->first(); 
    }

    static function updateProfile($data, $userid) {
        DB::beginTransaction();
        try {
            DB::table('admins')->where('id', $userid)->update($data);
            DB::commit();
            return true;
        } catch (Exception $ex) {
            DB::rollback(); return false;
        }
    }

}