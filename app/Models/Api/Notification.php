<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Functions;
use DB;

class Notification extends Model
{
    static function getNotifications($user){
        $userIds                =   [$user->id];
        if($user->is_parent     ==  1){
            $query              =   DB::table('users')->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ foreach($query->get() as $row){ $userIds[] = $row->id; } }
        }
        $query                  =   DB::table('notifications')->whereIn('notify_to',$userIds)->where('status',1)->orderBy('notify_on','desc');
        $data                   =   array();
        if($query->count()      >   0){ foreach($query->get() as $row){
            if($row->notify_from    >  0){ $row->notify_from = DB::table('user_details')->where('user_id',$row->notify_from)->first()->name; }
            else{ $row->notify_from =   'Admin'; } 
            $data[]             =   $row;
        } }
        Functions::updateNotifyCount($user->id,0,'push_notify');
        return array('status'=>'success','message'=>'Notification List','data'=>['notify_list'=>$data]);
    }
   
}
