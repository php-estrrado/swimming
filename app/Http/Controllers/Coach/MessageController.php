<?php

namespace App\Http\Controllers\Coach;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

use App\Models\Coach\Message;
use App\Models\Functions;
use Validator;
use Session;

class MessageController extends Controller{
    public function __construct(){ $this->middleware('auth'); }
  
    public function index(Request $request,$id=0){ 
        $post                       =   $request->post();
        $data['chatGroup']          =   'is-expanded active';
        $data['chatMenu']           =   'active';
        $data['userData']           =   Session::get('userData');
        $data['students']           =   Message::getStudents(auth()->user()->id);
        $data['chatList']           =   Message::chatList(auth()->user()->id,'','','data',$id);
        $data['chatHistory']        =   Message::getChatHistory(auth()->user()->id,0,'data');
        $data['title']              =   'Messages'; // echo '<pre>'; print_r($data); echo '</pre>'; die;
        return view('coach.pages.messages.message', $data);
    }
    
    function message($id){
        $data['chatHistory']        =   Message::getChatHistory(auth()->user()->id,$id,'data');
        return view('coach.pages.messages.content', $data);
    }
    
    function getMessage(Request $request){
        $post                       =   (object)$request->post();
        $messages                   =   Message::getChatMessages($post->chat_id,auth()->user()->id,'data',$post->last_id);
        $data['msgs']               =   $messages;
        if(count($messages)         >   0){ $lastId =  $messages['last_id']; }else{  $lastId = $post->last_id; }
        $data['last_id']            =   $lastId;
        return $data;
      //  return view('coach.pages.messages.new_messages', $data);
    }
    
    function save(Request $request){ 
        $post                       =   (object)$request->post(); 
        $result                     =   Message::sendChatMessage(auth()->user()->id,$post);
        return 'success';
    }
    
    function createMessage(Request $request,$id=0){
        $result                     =   Message::createNewChat(auth()->user()->id,$id);
        if($result > 0){ return redirect('/coach/messages/'.$result); }else{ return redirect('/coach/messages'); }
    }

    public function fnf() {
        return Redirect::to('coach');
    }

}

