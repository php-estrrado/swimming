@extends('coach.layouts.app')
@section('title', 'Messages')
@section('content')
<?php // echo '<pre>'; print_r($student); echo '</pre>';  echo 'ssss';
?>
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header"><h2 class="mb-2 fw">
                <div class="col-md-3 col-sm-6 col-10 fl">{{$title}}</div>
                <div class="col-md-1 col-sm-3 col-2 fl">
                    <div class="new-chat">
                        <div role="button" title="New Message">
                            <span data-icon="chat" class="">
                            <svg id="Layer_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30">
                                <path opacity=".55" fill="#263238" d="M19.005 3.175H4.674C3.642 3.175 3 3.789 3 4.821V21.02l3.544-3.514h12.461c1.033 0 2.064-1.06 2.064-2.093V4.821c-.001-1.032-1.032-1.646-2.064-1.646zm-4.989 9.869H7.041V11.1h6.975v1.944zm3-4H7.041V7.1h9.975v1.944z"></path>
                            </svg>
                        </span>
                        </div>
                    </div
                </div></h2>
            </div>
            <div class="clr"></div>
            <div class="card-body msg-body">
                <div class="row"> 
                    <div id="msg-list" class="col-12 col-md-4"> 
                        <div class="row" id="">
                            <ul class="nav nav-tabs "> <?php // echo '<pre>'; print_r($chatList); echo '</pre>';  die; ?>
                                @if(count($chatList) > 0) @php $fcId = $chatList['fcChatId']; unset($chatList['fcChatId']); @endphp
                                    @foreach($chatList as $k=>$row) <?php // echo '<pre>'; print_r($row['chat_id']); echo '</pre>';  echo $fcId; die; ?>
                                    <li id="{{$row['chat_id']}}" class="col-12 chat-list">
                                        <a class="link">
                                            <div class="fl user-img avthar"><img src="{{$row['avthar']}}"  class="rounded-circle"alt="" /></div>
                                            <div class="fl name">{{$row['name']}}</div>
                                            <div class="fr unread"> @php if($row['unread'] >0){ @endphp <span>{{$row['unread']}}</span> @php } @endphp </div>
<!--                                            <div class="fr time">{{$row['date']}}</div>-->
                                            <div class="clr"></div>
<!--                                            <div class="msg">{{mb_substr($row['chat_msg'], 0, 45)}}</div>-->
                                            
                                        </a>
                                    </li>
                                    @endforeach    
                                @else @php $fcId = 0; @endphp
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div id="messages" class="col-12 col-md-8">
                        @include('coach.pages.messages.content')
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('coach.pages.messages.students_modal')

<style>
    .msg-body{ padding-bottom: 1px; padding-top: 18px;}
    #msg-list{ background-color: #dee2e6;}
    #msg-list .nav-tabs{ background: transparent; }
    #msg-list .nav-tabs li{ border-bottom: 1px solid #f8f9fa;}
    #msg-list .nav-tabs li.active{ background: #fff;}
    #msg-list .nav-tabs li .name{ font-size: 14px; font-weight: bold; line-height: 45px; padding-left: 10px;}
    #msg-list .nav-tabs li .time{ font-size: 12px;}
    .nav-tabs .avthar img{ height: 45px; }
    #messages .container .title{ background: #f8f9fa; padding: 12px;}
    
    #msg-list .nav-tabs{ height: 445px; overflow-y: auto;}
    .comments-main{ height:317px; overflow-y: auto;}
    .comments-main.no-msg{ height: 371px;}
    .active-chat{ background: #fff;}
    .unread{ line-height: 50px;position: relative;right: -13px;}
    .unread span{ background: #2BC7DD; padding: 5px; border-radius: 50%;}
    #Layer_1{ cursor: pointer;}
    
    #myInput {
        background-image: url('/css/searchicon.png');
        background-position: 10px 12px;
        background-repeat: no-repeat;
        width: 100%;
        font-size: 16px;
        padding: 12px 20px 12px 40px;
        border: 1px solid #ddd;
        margin-bottom: 12px;
      }

      #myUL { list-style-type: none; padding: 0; margin: 0; height: 350px; overflow-y: auto; }

      #myUL li a {
        border: 1px solid #ddd;
        margin-top: -1px; /* Prevent double borders */
        background-color: #f6f6f6;
        padding: 12px;
        text-decoration: none;
        font-size: 16px;
        color: black;
        display: block
      }

      #myUL li a:hover:not(.header) {
        background-color: #eee;
      }
      #myUL li .user-img.avthar{ width: 50px;}
      #myUL li .user-img.avthar img{ height: 35px; position: relative; top: -5px; }

</style>
<script>

$.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

$(document).ready(function () {
   setTimeout(function () { 
   $("#chatMmessages").animate({ scrollTop: $('#chatMmessages').prop("scrollHeight")}, 1000);
    },2000);

   getChatMessages('{{$fcId}}');
   $('.nav-tabs #{{$fcId}} .unread').html('');
   $('#{{$fcId}}.chat-list').addClass('active-chat');
    $('.chat-list').on('click',function(){ 
        getChatMessages(this.id); 
        $('.chat-list').removeClass('active-chat'); $('#'+this.id).addClass('active-chat');
        $('#'+this.id+' .unread').html('');
    });
    
    $('#act-tab .nav-tabs li').on('click',function(){
        $('.nav-tabs li').removeClass('active'); $('#'+this.id).addClass('active'); 
        $('.activity-content .tab-pane').removeClass('active'); $('.activity-content #content-'+this.id).addClass('active');
    });
    
    $('body').on('submit','#chatForm',function(){ 
        var msg     =   $('#chatForm #chat_msg').val();
        var chatId  =   $('#chatForm #chat_id').val();
        if(msg == '') return false;
            $('#chatForm #chat_msg').attr('readonly',true); $('#chatForm #submit_btn').attr('disabled',true);
        saveMessage(chatId,msg);
        return false;
    });
    
    $('body').on('keypress','#chat_msg',function(event){ 
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            if( $('#chatForm #chat_msg').attr('disabled') == true){ return false; }
            var msg     =   $('#chatForm #chat_msg').val();
            var chatId  =   $('#chatForm #chat_id').val();
            if(msg == '') return false;
            $('#chatForm #chat_msg').attr('disabled',true); $('#chatForm #submit_btn').attr('disabled',true);
            saveMessage(chatId,msg);
            return false;
        }
    });
    
    $('#Layer_1').on('click',function(){ $('#studentsModal').modal('show'); });
    $('#close-btn').on('click',function(){ $('#studentsModal').modal('hide'); });
    
    $('#myUL li a').on('click',function(){
        var action  =   $('#newChatForm').attr('action')+'/'+this.id;
        var loadImg =   '<div style="text-align: center; position: relative; top: 40%"><img height="60" src="{{asset('public/coach/assets/img/ajax-loader.gif')}}" alt="Loading..." /></div>';
        $('#myUL').html(loadImg);
        $('#newChatForm').attr('action',action); $('#newChatForm').submit();
    });

});

function saveMessage(chatId,msg){
    $.ajax({
        type: 'POST',
        url: '{{url("/coach/message/save")}}',
        data: {chat_id:chatId,chat_msg: msg},
        success: function (data) {
            $('#chatForm #chat_msg').val(''); 
            $('#chatForm #chat_msg').attr('disabled',false);  $('#chatForm #submit_btn').attr('disabled',false);
//                setTimeout(function () {
//                     getNewMessages(chatId,$('#last_id').val());
//                 }, 3000);
        }
    });
    return false;
}

function togleTab(tabId,id){
    $('#act-tab .nav-tabs li').removeClass('active'); $('#'+tabId).addClass('active'); 
    $('#activity-content-'+id+' .tab-pane').removeClass('active'); $('#activity-content-'+id+' #content-'+tabId).addClass('active');
}

function getChatMessages(id){ 
    var loadImg =   '<div style="text-align: center; position: relative; top: 40%"><img height="60" src="{{asset('public/coach/assets/img/ajax-loader.gif')}}" alt="Loading..." /></div>';
    $('#messages').html(loadImg);
    $.ajax({
        type: 'GET',
        url: '{{url("/coach/message")}}/'+id,
     //   data: {id: id},
        success: function (data) {
           $('#messages').html(data);
           setTimeout(function () {
                getNewMessages(id,$('#last_id').val());
                $("#chatMmessages").animate({ scrollTop: $('#chatMmessages').prop("scrollHeight")}, 1000);
            }, 1000);
        }
    });
}

function getNewMessages(chatId,lastId){
    $.ajax({
        type: 'POST',
        url: '{{url("/coach/new/messages")}}',
        data: {chat_id: chatId,last_id:lastId},
        success: function (data) {
            $.each(data.msgs, function (key, value) {  if(value.msg_id != undefined){ 
                var msgList =   '<li><div class="row comments mb-2">';
                if(value.me ==  1){  var clas = 'coach';
                    msgList =   msgList+'<div class="col-md-2 col-sm-2 col-3 text-center user-img"><img id="profile-photo" src="'+value.avthar+'" class="rounded-circle" /></div>';
                }else{ var clas = 'student'; }
                msgList     =   msgList+'<div class="col-md-9 col-sm-9 col-9 comment rounded mb-2 '+clas+'">';
                msgList     =   msgList+'<h4 class="m-0"><a href="#">'+value.from+'</a></h4><time class="ml-3 fr">'+value.time+'</time><like></like>';
                msgList     =   msgList+'<p class="mb-0">'+value.message+'</p></div>';
                if(value.me ==  0){
                    msgList =   msgList+'<div class="col-md-2 col-sm-2 col-3 text-center user-img"><img id="profile-photo" src="'+value.avthar+'" class="rounded-circle" /></div>';
                }
                msgList     =   msgList+'</div></li>';
                 $('#last_id').val(data.last_id);
                $('#chat_msg_list').append(msgList);
           //    alert(value.msg_id);  
                $("#chatMmessages").animate({ scrollTop: $('#chatMmessages').prop("scrollHeight")}, 1000);
            } }); 
           setTimeout(function (){
                getNewMessages(chatId,data.last_id);
            }, 2000);
        }
    });
}

 function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";
        }
    }
}
</script>
@endsection