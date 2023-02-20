<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Functions extends Model
{
    public static function sendSms($phone = null, $smscontent = null, $username = null, $password = null,$senderId = null) {

            $message                =   urlencode($smscontent);
            $curl                   =   curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL         => "http://sms.estrrado.com/sendsms?uname=$username&pwd=$password&senderid=$senderId&to=$phone&msg=$message&route=T",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING    =>  "",
                CURLOPT_MAXREDIRS   =>  10,
                CURLOPT_TIMEOUT     =>  30,
                CURLOPT_HTTP_VERSION=>  CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST=> "GET",
            ));
            $response               =   curl_exec($curl);
            $err                    =   curl_error($curl);
            curl_close($curl);
            if ($err) { return "cURL Error #:" . $err; } else { return $response; }
    }
    
    public static function invalidToken(){
        return array('status'=>'error','message'=>'Invalid access token','data'=>array('errors' =>array('error'=>'Invalid access token','action'=>'login'))); 
    }
    
    public static function updateNotifyCount($userId, $count, $field){ DB::table('users')->where('id',$userId)->update([$field => $count]); }
        
  public static function sendEmail($from = NULL, $to = NULL, $sub = NULL, $msg = NULL){
        $system_name    =   "Ping";
        $headers        =   "MIME-Version: 1.0" . "\r\n";
        $headers        .=  "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers        .=  'From: ' . $system_name . '<' . $from . '>' . "\r\n";
        $headers        .=  "Reply-To: " . $system_name . '<' . $from . '>' . "\r\n";
        $headers        .=  "Return-Path: " . $system_name . '<' . $from . '>' . "\r\n";
        $headers        .=  "X-Priority: 3\r\n";
        $headers        .=  "X-Mailer: PHP" . phpversion() . "\r\n";
        $headers        .=  "Organization: " . $system_name . "\r\n";
        @mail($to, $sub, $msg, $headers, "-f " . $from);

    }
    
    public static function pushNotify($title='',$message,$deviceToken,$count,$pg='',$detail='',$os='android'){
        if($deviceToken != ''){
            if(isset($pg)){ $page = $pg; }else{ $page = ''; }
            $passphrase = "";
            $accessKey              =   push()->fire_base_id; 
            $deviceTokens           =   array($deviceToken);
            if($os == 'ios'){
                $msg                =   array( 'title'=>$title,'type' => $page,'detail' => $detail,'badge' => $count,'content_available'=>1 );
                $fields             =   array( 'registration_ids' => $deviceTokens, 'data' => $msg,'notification'=>['body' => $message,'sound' => 'default'],'priority'=>'high' );
            }else{
                $msg                =   array( 'title'=>$title,'body' => $message,'sound' => 'default','type' => $page,'detail' => $detail,'badge' => $count,'content_available'=>1 );
                $fields             =   array( 'registration_ids' => $deviceTokens, 'data' => $msg,'priority'=>'high' );
            }
            $headers                =   array( 'Authorization: key=' . $accessKey, 'Content-Type: application/json' );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
          //  return $result;
        }
    }   
    
    public static function pushNotify_test($title='',$message,$deviceToken,$count,$pg='',$detail='',$os='android'){
        if($deviceToken != ''){
            if(isset($pg)){ $page = $pg; }else{ $page = ''; }
            $passphrase = "";
            $accessKey              =   'AIzaSyCivfp1_S4a_IazCANc_1yj3ux4-khmgIg'; 
            $deviceTokens           =   array($deviceToken);
            if($os == 'ios'){
                $msg                =   array( 'title'=>$title,'type' => $page,'detail' => $detail,'badge' => $count,'content_available'=>1 );
                $fields             =   array( 'registration_ids' => $deviceTokens, 'data' => $msg,'notification'=>['body' => $message,'sound' => 'default'],'priority'=>'high' );
            }else{
                $msg                =   array( 'title'=>$title,'body' => $message,'sound' => 'default','type' => $page,'detail' => $detail,'badge' => $count,'content_available'=>1 );
                $fields             =   array( 'registration_ids' => $deviceTokens, 'data' => $msg,'priority'=>'high' );
            }
            $headers                =   array( 'Authorization: key=' . $accessKey, 'Content-Type: application/json' );
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
          //  return $result;
        }
    }   
    
    public static function addNotification($userId,$userId2,$refId,$type,$msg,$title=''){
        DB::table('notifications')->insert(['notify_from'=>$userId,'notify_to'=>$userId2,'ref_id'=>$refId,'type'=>$type,'title'=>$title,'message'=>$msg,'notify_on'=>date('Y-m-d H:i:s')]);
    }
}
