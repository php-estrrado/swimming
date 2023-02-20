<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use DB;

class Coach extends Model
{
    static function getCoaches($active=''){
        if($active          ==  'pending'){ $af = '='; }else{ $af = '!='; }
        return DB::table('users as U')->select('U.*','D.*','C.name as location')->join('user_details as D','U.id','=','D.user_id')->leftJoin('cities as C','D.city','=','C.id')
            ->where('U.user_type',1)->where('active_from',$af,NULL)->where('U.status',1)->get();
    }
    
    static function getCoach($id){
        return DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.user_type',1)->where('U.id',$id)->first();
    }
    
    static function getDisabledCoaches(){
        return DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.user_type',1)->where('U.status',0)->get();
    }
    
    static function restoreUser($id){ return DB::table('users')->where('id',$id)->update(['status'=>1]); }

    static function updateStatus($post){ 
        $user               =   DB::table('users')->where('id',$post->id)->first();
        $data               =   ['active'=>$post->active];
        if($user->active_from   ==  NULL){ $data['active_from'] = date('Y-m-d H:i:s'); }
        return DB::table($post->table)->where('id',$post->id)->update($data); 
    }
    
    static function deleteCoach($post){ return DB::table($post->table)->where('id',$post->id)->update(['status'=>0]); }
    
    static function saveCoach($post, $id){
        if($id > 0){
            $data           =   ['phone'=>$post->phone,'email'=>$post->email,'active'=>$post->active];
            if($post->password  != ''){ $data['password'] = Hash::make($post->password); }
            $user           =   DB::table('users')->where('id',$id)->update($data);
            if($user){ DB::table('users')->where('id',$id)->update(['updated_at'=>date('Y-m-d H:i:s')]); }
            $userDtl        =   DB::table('user_details')->where('user_id',$id)->update(['name'=>$post->name,'address1'=>$post->address1,'city'=>$post->location]);
            if($user){ DB::table('user_details')->where('user_id',$id)->update(['modified'=>date('Y-m-d H:i:s')]); }
            return true;
        }else{
            $data           =   ['phone'=>$post->phone,'email'=>$post->email,'active'=>$post->active,'active_from'=>date('Y-m-d H:i:s'),'created_at'=>date('Y-m-d H:i:s')];
            $data['password'] = Hash::make($post->password);
            $userId         =   DB::table('users')->insertGetId($data);
            if($userId){       
                DB::table('user_details')->insert(['user_id'=>$userId,'name'=>$post->name,'address1'=>$post->address1,'city'=>$post->location,'created'=>date('Y-m-d H:i:s')]); 
                return $userId;
        }else{ return false; }
        }
    }
    
    static function getLocations(){
       $query              =   DB::table('cities')->where('status',1);
       $data               =   array();
       if($query->count()  >   0){ foreach($query->get() as $row){ $data[$row->id] = $row->name; } }
       return $data;
    }
}
