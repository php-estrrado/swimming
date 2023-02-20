<div class="modal fade" id="studentsModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="ms-title" class="modal-title">Student List</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            {{ Form::open(array('url' => "coach/message/create/", 'id' => 'newChatForm', 'name' => 'newChatForm', 'class' => '')) }}
            <div class="modal-body">
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Searchy.." title="Type in a name">

                <ul id="myUL">
                    @if($students) 
                    @foreach($students as $row)
                        <li>
                            <a id="{{$row->user_id}}" href="#">
                                <span class="fl user-img avthar"><img src="{{$row->avthar}}"  class="rounded-circle"alt="" /></span>
                                <span class="std-name">{{$row->name}}</span>
                            </a>
                        </li>
                    @endforeach
                    @else
                    <li><span class="std-name">No User found.</span></li>
                    @endif
                </ul>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <div class="fr">
                        <button id="close-btn" type="button" class="btn btn-edit mt-1">Cancel</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>