<?php

namespace App\Models\Coach;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Functions;
use DB;
use Session;

class Message extends Model {
   static function getChatCoaches($user,$childId,$srField='',$srVal='',$type=''){
        $where                  =   [['R.status','=',1],['R.reg_status','=',1],['U.user_type','=',1],['U.active','=',1],['U.status','=',1]];
        if($srField             !=  ''  && $srVal != ''){ $where[] = [$srField,'like','%'.$srVal.'%']; }
        if($childId > 0){
            $userIds            =   array($childId);
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  ==  0){return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.'])); }
        }else{
            $userIds            =   array($user->id);
            $query              =   DB::table('users')->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  >   0){ foreach($query->get() as $row){ $userIds[]  =   $row->id; } }
        }
        $query                  =   DB::table('registered_courses as R')->select('U.id','U.phone','D.name','D.avthar')
                                    ->join('users as U','R.coach_id','=','U.id')->join('user_details as D','U.id','=','D.user_id')
                                    ->whereIn('R.student_id',$userIds)->where($where)->groupBy('R.coach_id');
        if($query->count()      >   0){ foreach($query->get() as $row){
            if($row->avthar     !=  '' || $row->avthar != NULL){ $row->avthar = url('/storage'.$row->avthar); }else{ $row->avthar = url('/storage/app/public/user.png'); }
            $data[]             =   $row;
    } }else{ $data = array(); }
        if($type == 'data'){ return $data; }
        return array('status'=>'success','message'=>'Coach List','data'=>['coach_list'=>$data]); 
    }
    
    static function chatList($userId,$srField='',$srVal='',$type='',$chId=0){
        $date = date('d-m-y');      $fcChatId = $chId;
        if($srField             !=  ''  && $srVal != ''){
            $query              =   DB::table('chat as C')->leftJoin('chat_members as CM', 'C.id','=','CM.chat_id')->join('chat_messages as M', 'C.id','=','M.chat_id')
                                    ->where(function ($query) use ($userId){ $query->where('CM.user_id',$userId)->orWhere('C.created_by',$userId); })
                                    ->where('C.status',1)->where('M.'.$srField,'like','%'.$srVal.'%')->orderBy('C.last_msg_on','desc')->groupBy('CM.chat_id');
        }else{
            DB::table('users')->where('id',$userId)->update(['chat_notify'=>0]);
            $query              =   DB::table('chat as C')->leftJoin('chat_members as CM', 'C.id','=','CM.chat_id')
                                    ->where(function ($query) use ($userId){ $query->where('CM.user_id',$userId)->orWhere('C.created_by',$userId); })
                                    ->where('C.status',1)->orderBy('C.last_msg_on','desc')->groupBy('CM.chat_id');
        }
        if($query->count()      >   0){ $i=0; foreach($query->get() as $row){ 
            if($row->group      ==  0){   
                if($row->created_by ==  $userId){ $memberId = $row->member; }else{ $memberId = $row->created_by; }
                $member         =   DB::table('user_details')->where('user_id',$memberId)->first();
                if($member){ $name  =   $member->name; }else{ $name = ''; }  $chatMembers = null;
            if($member) {   if($member->avthar  != '' && $member->avthar != NULL){ $avthar  = url('/storage'.$member->avthar); }else{ $avthar = url('storage/app/public/user.png'); } }
            else{ $avthar = url('storage/app/public/user.png'); }
                
            }else{ 
                $name           =   $row->name;  
                if($row->group_img  != '' && $row->group_img != NULL){ $avthar  = url('/storage'.$row->group_img); }else{ $avthar = url('storage/app/public/group.png'); }
                $chatMembers    =   Message::getGroupMembers($userId,$row->created_by,$row->id,'');
            }
            $where              =   [['chat_id','=',$row->chat_id],['deleted','=',0],['status','=',1]];
            $today              =   date('Y-m-d'); 
            $yesterday          =   date('Y-m-d', strtotime("-1 days", strtotime($today)));
            if($srField         !=  ''  && $srVal != ''){
               $qry             =   DB::table('chat_messages')->where($where)->where($srField,'like','%'.$srVal.'%')->orderBy('created_on','desc'); 
               if($qry->count() >   0){ foreach($qry->get() as $msg){  if($i == 0 && $fcChatId == 0){ $fcChatId = $msg->chat_id; $i++; }
                    if($today           ==  date('Y-m-d',strtotime($msg->created_on))){ $date = date('g:i a',strtotime($msg->created_on)); }
                    else if($yesterday  ==  date('Y-m-d',strtotime($msg->created_on))){ $date = 'Yesterday';  }
                    else{ $date         =   date("d M Y",strtotime($msg->created_on)); }
                    $res['chat_id']     =   $msg->chat_id; $res['chat_msg'] =   $msg->message;
                    $res['name']        =   $name;      $res['avthar']      =   $avthar;
                    $res['unread']      =   DB::table('chat_messages')->where('chat_id',$msg->chat_id)->where('to',$userId)->where('deleted',0)->where('noticed',0)->count();
                    $res['date']        =   $date;
                    $data[]             =   $res;
               }    $data['fcChatId']   =   $fcChatId; }else{ $data        =   array(); }
               return $data;
            }
            $chatMsg            =   DB::table('chat_messages')->where($where)->orderBy('created_on','desc')->first();
            if($chatMsg){            if($i == 0 && $fcChatId == 0){ $fcChatId = $row->chat_id; $i++; }
                $msg            =   $chatMsg->message; 
                $msgDate        =   $chatMsg->created_on;
                if($today       ==  date('Y-m-d',strtotime($msgDate))){ $date = date('g:i a',strtotime($msgDate)); }
                else if($yesterday  ==  date('Y-m-d',strtotime($msgDate))){ $date = 'Yesterday';  }
                else{ $date     =   date("d M Y",strtotime($msgDate)); }
            }else{ $msg = ''; }
            $res['chat_id']     =   $row->chat_id; 
            $res['name']        =   $name;
            $res['avthar']      =   $avthar;
            $res['unread']      =   DB::table('chat_messages')->where('chat_id',$row->chat_id)->where('to',$userId)->where('deleted',0)->where('noticed',0)->count();
            $res['chat_msg']    =   $msg;
            $res['date']        =   $date;
            $data[]             =   $res;
        }   $data['fcChatId']   =   $fcChatId; }else{ $data = array(); }
        if($type == 'data'){ return $data; }
        return array('status'=>'success','message'=>'Chat List','data'=>['chat_list'=>$data]);
    }
    
    static function createNewChat($userId,$studId){
        $query                  =   DB::table('chat as C')->select('C.id')->leftJoin('chat_members as CM', 'C.id','=','CM.chat_id')
                                    ->where(function ($qry) use ($userId,$studId){ $qry->where(function ($query) use ($userId,$studId){ $query->where('CM.user_id',$userId)->where('C.created_by',$studId); })
                                    ->orWhere(function ($query) use ($userId,$studId){ $query->where('CM.user_id',$studId)->where('C.created_by',$userId); }); })->where('C.status',1);
        if($query->count()      ==  0){ 
            $chatId             =   DB::table('chat')->insertGetId(['created_by'=>$userId,'created_on'=>date('Y-m-d H:i:s'),'member'=>$studId]);
            if($chatId){ DB::table('chat_members')->insert(['chat_id'=>$chatId,'user_id'=>$studId]); }
            else{ return array('status'=>'error','message'=>'Failed to create Chat','data'=>array('errors' =>['error1'=>'Failed to create Chat.'])); }
        }else{ $chatId          =   $query->first()->id; }
        return $chatId;
    }
    
    static function getChatHistory($userId,$chatId,$type=''){
        if($chatId == 0){ return ['chat_id'=>0,'chat_data'=>[],'chat_messages'=>[]]; }
        $chat                   =   DB::table('chat')->where('id',$chatId)->where('status',1)->first();
        $updReadStatus          =   Message::updateReadStatus($userId,$chat);
        DB::table('users')->where('id',$userId)->update(['chat_notify'=>0]);
        DB::table('chat_messages')->where('chat_id',$chatId)->where('to',$userId)->where('noticed',0)->update(['noticed'=>1]);
        if($chat->group == 0){    
            $member             =   DB::table('user_details')->where('user_id',$chat->member)->first();
            $name               =   $member->name;  $chatMembers = Message::getGroupMembers($userId,$chat->created_by,$chat->id,'');
        }else{ 
            $name               =   $chat->name;  
            $chatMembers        =   Message::getGroupMembers($userId,$chat->created_by,$chat->id,'');
        }
        $res['chat_id']         =   $chat->id;
        $res['name']            =   $chatMembers[0]['name'];
      //  $res['group']           =   $chat->group;
        $chatAvthar             =   Message::getChatAvthar($userId,$chat->id,$chat->created_by);
        if(count($chatAvthar)   >   0){ $res['avthar'] =   $chatAvthar[0]; }else{ $res['avthar'] = url('storage/app/public/user.png'); }
     //   $res['mambers']         =   $chatMembers;
        $messages               =   Message::getChatMessages($chatId,$userId,$type);
        if($type                ==  'data'){ return ['chat_id'=>$chat->id,'chat_data'=>$res,'chat_messages'=>$messages]; }
        return array('status'=>'success','message'=>'Chat History','data'=>['chat_id'=>$chat->id,'chat_data'=>$res,'chat_messages'=>$messages]);
    }
    
    static function updateReadStatus($userId,$chat){
        if($chat && $chat->unread !=  ''){  
            $unread = explode(',',$chat->unread); $unread  = array_diff($unread,array($userId)); 
            DB::table('chat')->where('id', $chat->id)->update(['unread'=>implode(',',$unread)]); return true;
        }
    }
    
    static function getGroupMembers($userId,$creater,$id,$dtl=''){ 
        $query                      =   DB::table('chat_members')->where([['chat_id','=',$id],['exit','=',0],['delete','=',0]])->get();
        $memberIds                  =   $data = array(); 
        $memberIds[]                =   $creater;
        $userId                     =   array($userId);
        if($query){ foreach($query  as  $row){    $memberIds[]  =   $row->user_id; } }
        $memberIds                  =   array_diff($memberIds,$userId);
        $users                      =   DB::table('users as U')->join('user_details as D', 'U.id','=','D.user_id')->whereIn('U.id',$memberIds);
        if($users->count()          >   0){ 
            if($dtl == 'all'){      return   $users->get(); }
            foreach($users->get()   as $user){
                $row                =   array();
                $row['number']      =   $user->phone;
                $row['name']        =   $user->name;
                $row['email']       =   $user->email;
                $row['user_id']     =   $user->user_id;
                if($user->avthar    !=  ''){ $row['avthar'] = url('/storage'.$user->avthar); }else{ $row['avthar'] = url('storage/app/public/user.png'); }
                array_push($data,$row);
            }
        }else{ return ''; }
        return $data;
    }
        
    static function getChatAvthar($userId=0,$chatId=0,$creator=0){
        $members                =   $userAvathar = array();
        $query                  =   DB::table('chat_members')->where('chat_id',$chatId)->where('exit',0)->where('delete',0);
        if($query->count()      >   0){ foreach($query->get() as $row){ $members[] = $row->user_id; } 
            $members            =   array_diff($members, array($userId));
            foreach($members    as  $memberId){
                $member         =   DB::table('user_details')->where('user_id',$memberId)->first();
                if($member->avthar != ''){ $userAvathar[] = url('/storage'.$member->avthar); }else{ $userAvathar[] = url('storage/app/public/user.png'); }
            }
        }
        return $userAvathar;
    }
    
    static function getChatMessages($id,$userId,$type='',$startId=0){
        $data                       =   array(); $read = '';
        $query                      =   DB::table('chat_messages')->where('chat_id',$id)->where('deleted',0)->where('status',1);
        if($type == 'data'){$query->where('id','>',$startId); }
        $query->orderBy('id','asc');
        if($query->count()          >   0){ 
            foreach($query->get()   as  $row){ $from[] = $row->from;
                $res                =   array();
                $user               =   DB::table('user_details')->where('user_id',$row->from)->first();
                if($row->from       ==  $userId){ $name = 'You'; $res['me'] = 1;}
                else{ $name         =   $user->name;  $res['me'] = 0; }
                $res['msg_id']      =   $row->id;
                $res['user_id']     =   $row->from;
                $res['chat_id']     =   $row->chat_id;
                $res['from']        =   $name;
                $res['message']     =   $row->message;
                $res['date']        =   date('Y-m-d', strtotime($row->created_on));
                $res['time']        =   date('H:i', strtotime($row->created_on));
                $avthar             =   DB::table('user_details')->where('user_id',$row->from)->first()->avthar;
                if($avthar          !=  ''){ $res['avthar'] = url('/storage'.$avthar); }else{ $res['avthar'] = url('storage/app/public/user.png'); }
                array_push($data,$res);
            }
            $data['last_id']        =   $row->id;
        }
        return $data;
    }
    
    static function sendChatMessage($userId, $post){
        $res                    =   array(); 
        $user                   =   DB::table('users as U')->join('user_details as D','U.id','=','D.user_id')->where('U.id', $userId)->first();
        $currTime               =   date('Y-m-d H:i:s');
        DB::table('users')->where('id',$userId)->update(['chat_notify'=>0]);
        DB::table('chat')->where('id',$post->chat_id)->update(['last_msg_on'=>$currTime]);
        $chat                   =   DB::table('chat')->where('id',$post->chat_id)->where('status',1)->first();
        $friends                =   Message::getGroupMembers($userId,$chat->created_by,$post->chat_id,'all');
        if($chat->group == 0){      $to = $friends[0]; $to = $to->user_id; $title = $user->name; }else{ $to = $chat->member; $title = $chat->name; }
        $data                   =   array('chat_id'=>$chat->id,'from'=>$userId,'to'=>$to,'message'=>$post->chat_msg,'created_on'=>$currTime);
        $insertId               =   DB::table('chat_messages')->insertGetId($data);
        $msg                    =   " You have message from ".$user->name;
        $notifyParms            =   array('me'=>0,'chat_id'=>$post->chat_id,'message'=>$post->chat_msg,'msg_id'=>$insertId,'user_id'=>$userId);
        $notifyParms['from']    =   $user->name; $notifyParms['date'] = date('Y-m-d'); $notifyParms['time'] = date('H:i');
        if(count($friends)      >   0){ $frIds = array();
            foreach($friends    as  $friend){
                $chatNotify     =   $friend->chat_notify; $chatNotify++; $frIds[] = $friend->user_id; 
                Functions::pushNotify($title,$post->chat_msg,$friend->deviceToken,$chatNotify,'chat',$notifyParms,$friend->os);
                Functions::updateNotifyCount($friend->user_id,$chatNotify,'chat_notify');
            }
            $unread             =   array_merge(explode(',',$chat->unread),$frIds); $unread = array_unique($unread);
         //   DB::table('chat')->where('id', $chat->id)->update(['unread'=>implode(',',$unread),'last_msg_on'=>$currTime]);
            $response           =   array('status'=>'success','message'=>'Submitted Successfully!','data'=>['message'=>'Chat message added successfully!']);
        }else{ $response        =   array('status' =>'error','message'=>"Failed",'data'=>['error1'=>'Message failed to send']); }
        return $response;
    }
    
    static function searchChat($user,$childId, $post){
        if($childId > 0){
            $query              =   DB::table('users')->where('id',$childId)->where('parent',$user->id)->where('active',1)->where('status',1);
            if($query->count()  ==  0){return array('status'=>'error','message'=>'Invalid child ID','data'=>array('errors' =>['error1'=>'Invalid child ID.'])); }
        }
        $data['coach_list']     =   Message::getChatCoaches($user,$childId,'D.name',$post->search,'data');
        $data['chat_list']      =   Message::chatList($user->id,'message',$post->search,'data');
        
        
        return array('status'=>'success','message'=>'Search Result','data'=>$data);
    }
    
    static function sendPush($user){
        $notifyParms            =   array('me'=>0,'chat_id'=>9,'message'=>'Test Message','msg_id'=>3,'user_id'=>$user->id);
        $notifyParms['from']    =   'Jay'; $notifyParms['date'] = date('Y-m-d'); $notifyParms['time'] = date('H:i');
        $notifyParms['avthar']  =   url('storage/app/public/user.png');
        Functions::pushNotify('Merlin','Test Message',$user->deviceToken,1,'chat',$notifyParms,$user->os);
        if($user->os == 'ios'){
            return array( 'registration_ids' => $user->deviceToken, 'data' => ['title'=>'Msg title','type' => 'chat','detail' => $notifyParms,'badge' => 1,'content_available'=>1],'notification'=>['body' => 'Test Message','sound' => 'default'],'priority'=>'high' );
        }else{ return array( 'title'=>'Merlin','body' => 'Test Message','sound' => 'default','type' => 'chat','detail' => $notifyParms,'badge' => 1,'content_available'=>1 ); }
    }
    
    static function getStudents($userId){
        $query                  =   DB::table('registered_courses as C')->select('U.*')->join('users as U','C.student_id','=','U.id')
                                    ->where('C.coach_id',$userId)->where('C.status',1)->where('U.status',1)->groupBy('C.student_id');
        if($query->count()      >   0){  foreach($query->get() as $row){ $usrIds[] = $row->id; if($row->parent > 0){ $usrIds[] = $row->parent; } }
            $query              =   DB::table('users as U')->select('D.*')->join('user_details as D','U.id','=','D.user_id')
                                    ->whereIn('U.id',$usrIds)->where('U.status',1)->orderBy('name','asc');
            if($query->count()  >   0){ foreach($query->get() as $row){
                if($row->avthar !=  ''){ $row->avthar = url('/storage'.$row->avthar); }else{ $row->avthar = url('storage/app/public/user.png'); }
                $data[]         =   $row;
            } return $data; }else{ return false; }
        }else{ return false; }
    }   
}
