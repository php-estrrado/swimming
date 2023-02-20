<?php

namespace App\Http\Controllers\Api\Student;

use App\Models\Api\Chat;
use App\Models\Functions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ActiveChild;
use Validator;

class ChatController extends Controller
{
    public function index(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        return Chat::chatList($user->id);
    }

    public function coaches(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        if($request->post('child_id')){ $childId = $request->post('child_id'); }else{ $childId = 0; }
        if($childId > 0){ 
            $rules['child_id']  =   ['required', 'numeric', new ActiveChild]; 
            $validator          =   Validator::make($request->post(), $rules);
            if ($validator->fails()) {
                foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
                return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
            }
        }
        return Chat::getChatCoaches($user,$childId);
    }
    
    public function createChat(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        $validator              =   Validator::make($request->post(), ['coach_id'=>['required', 'numeric']]);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        return Chat::createNewChat($user->id,$request->post('coach_id'));
    }

    public function chatHistory(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        $validator              =   Validator::make($request->post(), ['chat_id'=>['required', 'numeric']]);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        return Chat::getChatHistory($user->id,$request->post('chat_id'));
    }
    
    public function sendMessage(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        $validator              =   Validator::make($request->post(), ['chat_id'=>['required','numeric'],'chat_msg'=>['required','string']]);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        return Chat::sendChatMessage($user->id, (object)$request->post());
    }
    
    public function search(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        $rules                  =   ['search'=>['required','string']];
        if($request->post('child_id')){ $childId    =   $request->post('child_id'); }else{ $childId = 0; }
        if($childId > 0){ $rules['child_id']        =   ['required', 'numeric', new ActiveChild]; }
        $validator              =   Validator::make($request->post(), $rules);
        if ($validator->fails()) {
            foreach($validator->messages()->getMessages() as $k=>$row){ $error[$k] = $row[0]; $errorMag[] = $row[0]; }  
            return array('status'=>'error','message'=>$errorMag[0],'data'=>array('errors' =>(object)$error));
        }
        return Chat::searchChat($user,$childId, (object)$request->post());
    }
    
    public function testPush(Request $request){
        $user                   =   validateToken($request->post('accesToken')); if(!$user){return Functions::invalidToken(); }
        return Chat::sendPush($user, (object)$request->post());
    }
    public function testResponse(Request $request){ 
        return Chat::saveResponse((object)$request->post());
    }
    public function testResponse1(Request $request){ 
        return Chat::saveResponse((object)$request->post());
    }
}
