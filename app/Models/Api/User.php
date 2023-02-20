<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Functions;
use App\Models\Email;
use DB;

class User extends Model
{
    static function saveTempUser($post) {
        $userData = $user       =   array();
        $crrTime                =   date('Y-m-d H:i:s');
        $otp                    =   rand(1000,9999);  $otp = 1234;
        $userData               =   [
                                        'phone'=>$post->phone,'email'=>$post->email,'user_type'=>2,'otp'=>$otp,
                                        'otp_sent_at'=>$crrTime,'created_at'=>$crrTime
                                    ];
        if(DB::table('temp_users')->where('phone',$post->phone)->count() > 0){ 
            $userId             =   DB::table('temp_users')->where('phone',$post->phone)->first()->id;
            DB::table('temp_users')->where('phone',$post->phone)->update($userData);
            DB::table('temp_user_details')->where('user_id',$userId)->update(['name'=>$post->name]);
        }else{ $userId          =   DB::table('temp_users')->insertGetId($userData); DB::table('temp_user_details')->insert(['user_id'=>$userId,'name'=>$post->name]); }

        if($userId){
            $sms                =   smsCredientials();
            $otpSms             =   'SW APP OTP:'.$otp;
          //  Functions::sendSms($post->phone,$otpSms,$sms->sms_username,$sms->sms_password,$sms->sms_sender_id);
            return array('status'=>'success','message'=>'OTP sent','data'=>array('message'=>'Registration OTP sent'));
        }
    }
    
    static function saveUser($post){ 
        $crrTime                =   date('Y-m-d H:i:s');
        $query                  =   DB::table('temp_users')->where('phone',$post->phone)->where('otp',$post->otp);
        if($query->count()      >   0){
            $user               =   $query->first();
            $detail             =   (array) DB::table('temp_user_details')->where('user_id',$user->id)->first();
            unset($user->id);       unset($user->otp); unset($detail['id']);
            $user               =   (array)$user;
            $insertId           =   DB::table('users')->insertGetId($user);
            if($insertId){
                $detail['user_id']  =   $insertId; DB::table('user_details')->insert($detail);
                $path               =   storage_path('app/public/users/'.$insertId);
                if(!is_dir($path)){ mkdir($path,0755,TRUE); } 
                DB::table('temp_users')->where('phone',$post->phone)->delete();
                return array('status'=>'success','message'=>'Registration Success','data'=>array('message'=>'You are successfully registered. You can login after admin approval.'));
            }
        }else{ return array('status'=>'error','message'=>'Invalid OTP','data'=>array('errors'=>['otp'=>'Invalid OTP'])); }
    }
    
    static function addType($post){
        $query                  =   DB::table('users')->where('phone',$post->phone);
        if($query->count()      >   0){
            $user               =   $query->first();
            if($user->is_parent ==  NULL){
                $update         =   DB::table('users')->where('phone',$post->phone)->update(['is_parent'=>$post->user_type]);
                if($update){ return array('status'=>'success','message'=>'User type updated','data'=>array('message'=>'User type updated successfully.')); }
                else{ return array('status'=>'error','message'=>'User type update failed','data'=>array('message'=>'User type failed to update.')); }
            }else{
                return array('status'=>'error','message'=>'User type already registered.','data'=>array('errors'=>['disable'=>'User type already registered with this account.'])); 
            }
        }else{
            return array('status'=>'error','message'=>'Not registered','data'=>array('errors'=>['disable'=>'Account have not registered with this phone number'])); 
        }
    }

        static function login($post){ 
        $query                  =   DB::table('users')->where('phone',$post->phone)->where('user_type',2);
        if($query->count()      >   0){
            $user               =   $query->first();
             if($user->status == 0){
                return array('status'=>'error','message'=>'Account disabled','data'=>array('errors'=>['disable'=>'Your account disabled. Please contact Admin'])); 
            }else if($user->active    ==  0 && $user->active_from == NULL){
                return array('status'=>'error','message'=>'Account not activated','data'=>array('errors'=>['not_active'=>'Your account not activated yet'])); 
            }else if($user->active  ==  0){
                return array('status'=>'error','message'=>'Account deactivated','data'=>array('errors'=>['disable'=>'Your account deactivated. Please contact Admin'])); 
            }else{
                $otp            =   rand(1000,9999);  $otp = 1234;
                $data           =   array('is_login'=>0,'access_token'=>0,'otp'=>$otp,'otp_sent_at'=>date('Y-m-d H:i:s'));
                $update         =   DB::table('users')->where('phone',$post->phone)->update($data);
                $sms            =   smsCredientials();
                $otpSms         =   'SW APP OTP:'.$otp;
             //   Functions::sendSms($post->phone,$otpSms,$sms->sms_username,$sms->sms_password,$sms->sms_sender_id);
                return array('status'=>'success','message'=>'OTP sent','data'=>array('message'=>'Login OTP sent'));
            }
        }else{ return array('status'=>'error','message'=>'Invalid phone number','data'=>array('errors'=>['otp'=>'Invalid phone number'])); }
    }

    static function getLoginData($post){
        $query                  =   DB::table('users')->where('phone',$post->phone)->where('otp',$post->otp);
        if($query->count()      >   0){
            $token              =   $query->first()->id.rand(100000,999999);
            $data               =   User::getUserDetails($query->first()->id);
            if($post->os){ $os  =   $post->os; }else{ $os = 'android'; }
            $updData            =   array('otp'=>NULL,'access_token'=>$token,'is_login'=>1,'deviceToken'=>$post->deviceToken,'os'=>$os);
            $data->access_token =   $token; $data->is_login =   1;
            if($data->avthar    != '' && $data->avthar != NULL){ $avthar = url('/storage'.$data->avthar); }else{ $avthar = url('/storage/app/public/user.png'); }
            $data->avthar       =   $avthar;
            DB::table('users')->where('id',$query->first()->id)->update($updData);
            $resp['userDetails']=   $data;
            return array('status'=>'success','message'=>'OTP verified','data'=>$resp);
        }else{ return array('status'=>'error','message'=>'Invalid OTP','data'=>array('errors'=>['otp'=>'Invalid OTP'])); }
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
    
    static function resendRegisterOtp($post){
        $query                  =   DB::table('temp_users')->where('phone',$post->phone);
        if($query->count()      >   0){
            $otp                =   rand(1000,9999); $otp = 1234;
            $data               =   array('is_login'=>0,'access_token'=>0,'otp'=>$otp,'otp_sent_at'=>date('Y-m-d H:i:s'));
            $update             =   DB::table('temp_users')->where('phone',$post->phone)->update($data);
            if($update){
                $sms            =   smsCredientials();
                $otpSms         =   'SW APP OTP:'.$otp;
              //  Functions::sendSms($post->phone,$otpSms,$sms->sms_username,$sms->sms_password,$sms->sms_sender_id);
                return array('status'=>'success','message'=>'OTP resent','data'=>array('message'=>'Registration OTP resent'));
            }else{  return array('status'=>'error','message'=>'OTP failed to resent','data'=>array('errors'=>['otp'=>'Registration OTP failed resent'])); }
        }
    }
    
    static function resendLoginOtp($post){
        $query                  =   DB::table('users')->where('phone',$post->phone);
        if($query->count()      >   0){
            $otp                =   rand(1000,9999); $otp = 1234;
            $data               =   array('is_login'=>0,'access_token'=>0,'otp'=>$otp,'otp_sent_at'=>date('Y-m-d H:i:s'));
            $update             =   DB::table('users')->where('phone',$post->phone)->update($data);
            if($update){
                $sms            =   smsCredientials();
                $otpSms         =   'SW APP OTP:'.$otp;
              //  Functions::sendSms($post->phone,$otpSms,$sms->sms_username,$sms->sms_password,$sms->sms_sender_id);
                return array('status'=>'success','message'=>'OTP resent','data'=>array('message'=>'Login OTP resent'));
            }else{  return array('status'=>'error','message'=>'OTP failed to resent','data'=>array('errors'=>['otp'=>'Login OTP failed resent'])); }
        }
    }

        static function existParent($post){
        $query                  =   DB::table('users')->where('phone',$post->phone)->where('status',1);
        if($query->count()      > 0 ){ return $query->first(); }else{ return false; }
    }

    static function isChildRegistered($user){
        if(DB::table('users')->where('parent',$user->id)->count() > 0){ return true; }else{ return false; }
    }
    
    static function saveChild($post, $parent){
        if($post){ foreach($post as $row){
            $row                =   (object) $row;
            $insData            =   ['phone'=>$row->phone,'email'=>$row->email,'relation'=>$row->relation,'parent'=>$parent->id,'user_type'=>2,'is_parent'=>0,'created_at'=>date('Y-m-d H:i:s')];
            $insId              =   DB::table('users')->insertGetId($insData);
            if($insId){ DB::table('user_details')->insert(['user_id'=>$insId,'name'=>$row->name]); }
        } }
        return array('status'=>'success','message'=>'Child added','data'=>['chiled_added'=>'Chiled has been added successfully!']);
    }
    
    static function getChildrenList($user){ 
        $query                  =   DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.parent',$user->id)->where('U.status',1);
        $result                 =   array();
        if($query->count()      >   0){ 
            foreach($query->get() as $row){
                $data           =   ['child_id'=>$row->user_id,'name'=>$row->name,'email'=>$row->email,'phone'=>$row->phone];
                if($row->avthar !=  ''){ $data['avthar'] = url('/storage'.$row->avthar); }else{ $data['avthar'] = url('/storage/app/public/user.png'); }
                $course         =   User::registeredCourses($row->user_id);
                $data['registered'] =   $course->registered;
                $data['approved']   =   $course->approved;
                $result[]       =   $data;
            } 
        }else{ $result          =   array(); }
        $userDtl                =   User::getUserDetails($user->id);
        return array('status'=>'success','message'=>'Children List','data'=>['children'=>$result,'userDetails'=>$userDtl]);
    }
    
    static function registeredCourses($userId){
        $data['registered']     =   DB::table('registered_courses')->where([['student_id','=',$userId],['active','=',1],['status','=',1]])->count();
        $data['approved']       =   DB::table('registered_courses')->where([['student_id','=',$userId],['status','=',1]])->count();
        return (object) $data;
    }
    
    static function Profile($user){
        $detail                 =   User::getUserDetails($user->id);
        if($detail->avthar      !=  '' || $detail->avthar != NULL){ $detail->avthar = url($detail->avthar); }else{ $detail->avthar = url('storage/app/public/user.png'); }
        $data['childrens']      =   NULL;
        if($user->is_parent     ==  0){ 
            $detail->course =   User::getCourseCounts($user->id); 
        }else{
            $detail->course     =   null;
            $query              =   DB::table('users')->where('parent',$user->id)->where('status',1);
            if($query->count()  >   0){ foreach($query->get() as $row){
                $child          =   User::getUserDetails($row->id);
                if($child->avthar != '' || $child->avthar != NULL){ $child->avthar = url($child->avthar); }else{ $child->avthar = url('storage/app/public/user.png'); }
                $child->course  =   User::getCourseCounts($row->id);
                $children[]     =   $child;
            } }else{ $children  =   array(); }
            $data['childrens']  =   $children; 
        }
        $data['profile']        =   $detail;
        return array('status'=>'success','message'=>'Profile','data'=>$data);
    }
    
    static function updateProfile($user,$childId,$post,$file){
        $query                  =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
        if($query->count()      >   0){ $userId = $query->first()->id; }else{ $userId = $user->id; }
        DB::table('users')->where('id',$userId)->update(['phone'=>$post->phone,'email'=>$post->email]);
        $ueseData               =   ['name'=>$post->name];
        if($file){if($file->move(storage_path() . '/app/public/users/'.$userId.'/', 'avthar.png')){
            $ueseData['avthar'] =   '/app/public/users/'.$userId.'/avthar.png';
        } }
        DB::table('user_details')->where('user_id',$userId)->update($ueseData);
        return array('status'=>'success','message'=>'Profile Updated','data'=>['profile_update'=>'Profile details updated successfully!']);
    }

        static function getCourseCounts($userId){
        $where                  =   [['C.student_id','=',$userId],['C.active','=',1],['C.status','=',1],['A.status','=',1],];
        $data['courses']        =   DB::table('registered_courses')->where('student_id',$userId)->where('active',1)->where('status',1)->count();
        $data['comp_activity']  =   DB::table('registered_course_activities as A')->join('registered_courses as C','A.reg_course_id','=','C.id')
                                    ->where($where)->where('C.active',1)->where('A.curr_status',3)->count();
        $data['pend_activity']  =   DB::table('registered_course_activities as A')->join('registered_courses as C','A.reg_course_id','=','C.id')
                                    ->where($where)->where('C.active',1)->whereIn('A.curr_status',[0,2])->count();
        return $data;
    }
}
