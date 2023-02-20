<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use DB;

class Student extends Model
{
    static function getStudents(){ $data = array();
        $query                  =   DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.user_type',2)->where('U.status',1);
        if($query->count()      >   0){ foreach($query->get() as $row){
            if($row->is_parent  ==  0){ $row->parent_name   =   Student::getParentName($row->parent); }else{ $row->parent_name = 'Nill'; }
            $data[]             =   $row;
        } }
        return $data;
    }
    
    static function getStudent($id){
        return DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.user_type',2)->where('U.id',$id)->where('U.status',1)->first();
    }
    
    static function getChildren($pId){
        return DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.user_type',2)->where('parent',$pId)->where('U.status',1)->get();
    }

    static function getDisabledStudents(){
        $data                   =   false;
        $query                  =   DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.user_type',2)->where('U.status',0);
        if($query->count()      >   0){ foreach($query->get() as $row){
            if($row->is_parent  ==  0){ $row->parent_name   =   Student::getParentName($row->parent); }else{ $row->parent_name = 'Nill'; }
            $data[]             =   $row;
        } }
        return $data;
    }
    
    static function updateStatus($post){ 
        $user               =   DB::table('users')->where('id',$post->id)->first();
        $data               =   ['active'=>$post->active];
        if($post->active    ==  1 && $user->active_from   ==  NULL){ $data['active_from'] = date('Y-m-d H:i:s'); }
        return DB::table($post->table)->where('id',$post->id)->update($data); 
    }
    
    static function deleteStudent($post){ return DB::table($post->table)->where('id',$post->id)->update(['status'=>0]); }
    
    static function saveStudent($post, $id){
        if($id > 0){
            $data           =   ['phone'=>$post->phone,'email'=>$post->email,'active'=>$post->active];
      //      if($post->password  != ''){ $data['password'] = Hash::make($post->password); }
            $user           =   DB::table('users')->where('id',$id)->update($data);
            if($user){ DB::table('users')->where('id',$id)->update(['updated_at'=>date('Y-m-d H:i:s')]); }
            $userDtl        =   DB::table('user_details')->where('user_id',$id)->update(['name'=>$post->name]);
            if($user){ DB::table('user_details')->where('user_id',$id)->update(['modified'=>date('Y-m-d H:i:s')]); }
            return true;
        }else{
            $data           =   ['phone'=>$post->phone,'email'=>$post->email,'active'=>$post->active,'user_type'=>2,'created_at'=>date('Y-m-d H:i:s')];
             $data['parent'] =   $post->parent; $data['is_parent'] =   $post->is_parent;
            if($post->active    ==  1){ $data['active_from'] = date('Y-m-d H:i:s'); }
         //   $data['password'] = Hash::make($post->password);
            $userId         =   DB::table('users')->insertGetId($data);
            if($userId){       
                DB::table('user_details')->insert(['user_id'=>$userId,'name'=>$post->name,'created'=>date('Y-m-d H:i:s')]); 
                return $userId;
        }else{ return false; }
        }
    }
    
    static function getParentName($id){
        $query                  =   DB::table('user_details')->where('user_id',$id);
        if($query->count()      >   0){ return $query->first()->name; }else{ return 'Nill'; }
    }
}
