<link href="{{asset('public/coach/assets/css/chat.css')}}" rel="stylesheet">
<div class="container">
    @if(count($chatHistory) > 0) 
        @if(count($chatHistory['chat_data']) > 0)
        @php $chatData = $chatHistory['chat_data']; $messages = $chatHistory['chat_messages']; $lastId = 0; @endphp 
              <?php // echo '<pre>'; print_r($chatData); echo '</pre>'; // die; ?>  
        <div class="col-md-2 col-sm-2 col-3 text-center user-img fl">
            <img id="profile-photo" src="{{$chatData['avthar']}}" class="rounded-circle" style="height: 50px;" />
        </div>
        <div class="col-md-10 col-sm-10 col-9 fl">
            <div class="title">{{$chatData['name']}}</div>
        </div>
        <div class="clr"></div>
        {{Form::hidden('chat_id',$chatData['chat_id'],['id'=>'chat_id'])}} 
            <div class="row mt-1">
                <div id="chatMmessages" class="col-12 comments-main pt-4 rounded">
                    <ul id="chat_msg_list" class="p-0">
                        @if(count($messages) > 0) @php $lastId = $messages['last_id']; @endphp
                        @foreach($messages as $row) @if($row['msg_id'] > 0)
                            <li>
                                <div class="row comments mb-2">
                                    @php if($row['me'] == 1){ $class = 'coach'; @endphp
                                    <div class="col-md-2 col-sm-2 col-3 text-center user-img">
                                        <img id="profile-photo" src="{{$row['avthar']}}" class="rounded-circle" />
                                    </div>
                                    @php }else{ $class = 'student'; } @endphp
                                    <div class="col-md-9 col-sm-9 col-9 comment rounded mb-2 {{$class}}">
                                            <h4 class="m-0"><a href="#">{{$row['from']}}</a></h4>
                                        <time class="ml-3 fr">{{$row['time']}}</time>
                                        <like></like>
                                        <p class="mb-0"><?php echo $row['message']?></p>
                                    </div>
                                    @php if($row['me'] == 0){ @endphp
                                    <div class="col-md-2 col-sm-2 col-3 text-center user-img">
                                        <img id="profile-photo" src="{{$row['avthar']}}" class="rounded-circle" />
                                    </div>
                                    @php } @endphp
                                </div>
                            </li>
                            @endif @endforeach 
                            @endif
                        </ul>
                        {{Form::hidden('last_id',$lastId,['id'=>'last_id'])}}
                    </div>
                    <div class="clr"></div>
                </div>
            
            <div class="col-12 row comment-box-main p-3 rounded-bottom">
                {{ Form::open(array('url' => "coach/message/save", 'id' => 'chatForm', 'name' => 'chatForm', 'class' => 'col-12','files'=>'true')) }}
                <div class="row">
                    <div class="col-md-9 col-sm-9 col-9 pr-0 comment-box">
                        {{Form::hidden('chat_id',$chatData['chat_id'],['id'=>'chat_id'])}}
                        {{Form::textarea('chat_msg','',['id'=>'chat_msg','class'=>'form-control','placeholder'=>'Type Message','rows'=>1])}}
                    </div>
                    <div class="col-md-3 col-sm-2 col-2 pl-0 text-center send-btn">{{Form::submit('Send',['id'=>'submit_btn','class'=>'btn btn-info'])}}</div>
                </div>
                {{Form::close()}}
            </div>
        @endif
    @endif
</div>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/vue/0.12.14/vue.min.js'></script>
  <script type="text/javascript">
      
  </script>
