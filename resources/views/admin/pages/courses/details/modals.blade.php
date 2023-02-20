<!-- Add/Edit Milestone Modal Starts-->
<div class="modal fade" id="addMilestone">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="ms-title" class="modal-title">Add Milestone</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            {{ Form::open(array('url' => "admin/milestone/save", 'id' => 'addMsForm', 'name' => 'addMsForm', 'class' => '')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('ms_name', 'Milestone Name', ['class' => 'control-label','maxlength'=>150]) }}
                            {{Form::text('ms_name', '', ['id'=>'ms_name','class' => 'form-control'])}}
                            <span id="error_ms_name" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('active', 'Status', ['class' => 'control-label required']) }}
                            {{Form::select('active',[1=>'Active',0=>'Inactive'],'',['id'=>'edit-ms-active','class'=>'form-control required chosen-select'])}}
                        </div>
                    </div>
                    <div class="col-md-12 ">
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <div class="fr">
                        <input type="hidden" name="msId" id="msId" value="0"><input type="hidden" name="cId" id="cId" value="{{$id}}">
                        <button id="ms-close-btn" type="button" class="btn btn-edit mt-1">Cancel</button>
                        <button id="submit-ms" type="submit" class="btn btn-primary mt-1">Save</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Add/Edit Milestone Modal Ends-->

<!-- Add/Edit Activity Modal Starts-->
<div class="modal fade" id="addActivity">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="act-title" class="modal-title">Add Activity</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            {{ Form::open(array('url' => "admin/activity/save", 'id' => 'addActForm', 'name' => 'addActForm', 'class' => '')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('activity_name', 'Activity Name', ['class' => 'control-label','maxlength'=>150]) }}
                            {{Form::text('activity_name', '', ['id'=>'activity_name','class' => 'form-control'])}}
                            <span id="error_act_name" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('activity_desc', 'Description', ['class' => 'control-label']) }}
                            {{Form::textarea('activity_desc', '', ['id'=>'activity_desc','class' => 'form-control','rows'=>12,'maxlength'=>750])}}
                            <span id="error_act_desc" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('active', 'Status', ['class' => 'control-label required']) }}
                            {{Form::select('active',[1=>'Active',0=>'Inactive'],'',['id'=>'edit-act-active','class'=>'form-control required chosen-select'])}}
                        </div>
                    </div>
                    <div class="col-md-12 ">
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <div class="fr">
                        <input type="hidden" name="actId" id="actId" value="0">
                        <button id="act-close-btn" type="button" class="btn btn-edit mt-1">Cancel</button>
                        <button id="submit-act" type="submit" class="btn btn-primary mt-1">Save</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Add/Edit Activity Modal Ends-->

<!-- Add/Edit Activity Media Modal Starts-->
<div class="modal fade" id="addActivityMedia">
    <div id="act-media-modal" class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="act-title" class="modal-title">Add Activity Media</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div id="actMediaContent" class="modal-body"> 

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <div class="fr">
                        <input type="hidden" name="mActId" id="mActId" value="0">
                        <button id="mAct-close-btn" type="button" class="btn btn-edit mt-1">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Add/Edit Activity Media Modal Ends-->


<!-- Add / Edit Group Modal Starts-->
<div class="modal fade" id="addNewGRoup">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="group-title" class="modal-title">New Group</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            {{ Form::open(array('url' => "admin/course/group/save", 'id' => 'groupForm', 'name' => 'groupForm', 'class' => '')) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        {{Form::hidden('group_id',0,['id'=>'group_id'])}} 
                        {{Form::hidden('group[course_id]',$id,['id'=>'course_id'])}} {{Form::hidden('group[ms_id]',0,['id'=>'ms_id'])}}
                        {{ Form::label('group_name', 'Group Name', ['class' => 'control-label','maxlength'=>150]) }}
                        {{Form::text('group[group_name]', '', ['id'=>'group_name','class' => 'form-control'])}}
                        <span id="error_group_name" class="error"></span>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        {{ Form::label('active', 'Status', ['class' => 'control-label required']) }}
                        {{Form::select('group[active]',[1=>'Active',0=>'Inactive'],'',['id'=>'gr_active','class'=>'form-control required chosen-select'])}}
                    </div>
                    <div class="col-md-12 ">
                    </div>
                </div>
                <div class="col-12"><div class="row"><h4>Activities</h4></div></div>
                <div id="gr-model-activities">
                    @include('admin.pages.courses.details.group_model_activities')
                </div>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <div class="fr">
                        <button id="group-close-btn" type="button" class="btn btn-edit mt-1">Cancel</button>
                        <button id="submit-group" type="submit" class="btn btn-primary mt-1">Save</button>
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
<!-- Add / Edit Group Modal Ends-->

<!-- Assign Activity Modal Starts-->
<div class="modal fade" id="assignActivity">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 id="act-title" class="modal-title">Assign Activity for</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                {{ Form::open(array('url' => "admin/activity/save", 'id' => 'assignActForm', 'name' => 'assignActForm', 'class' => '')) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('activity_name', 'Activity Name', ['class' => 'control-label','maxlength'=>150]) }}
                            {{Form::text('activity_name', '', ['id'=>'activity_name','class' => 'form-control'])}}
                            <span id="error_act_name" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('activity_desc', 'Description', ['class' => 'control-label']) }}
                            {{Form::textarea('activity_desc', '', ['id'=>'activity_desc','class' => 'form-control','rows'=>12,'maxlength'=>750])}}
                            <span id="error_act_desc" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('active', 'Status', ['class' => 'control-label required']) }}
                            {{Form::select('active',[1=>'Active',0=>'Inactive'],'',['id'=>'edit-act-active','class'=>'form-control required chosen-select'])}}
                        </div>
                    </div>
                    <div class="col-md-12 ">
                    </div>
                </div>
                {{ Form::close() }}

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <div class="col-md-12 ">
                    <div class="fr">
                        <input type="hidden" name="actId" id="actId" value="0">
                        <button id="act-close-btn" type="button" class="btn btn-edit mt-1">Cancel</button>
                        <button id="submit-act" type="submit" class="btn btn-primary mt-1">Save</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Assign Activity Modal Ends-->

<div id="additional_act_media" style="display: none;">
    <div id="add_img_id" class="col-md-4 col-sm-6 mb-2">
        <div class="col-12 mb-2 fl">
            <div class=""><i id="add_del_media_id" class="fr fa fa-trash media-del del-act-media">&nbsp;</i></div>
        </div>
        <div class="col-12 mb-2">
            <img id="add_src_id" src="add_src_url" alt="Course Image" style="width: 100%;" />
        </div>
    </div>
</div>

<style> 
    #act-media-modal{ min-width: 75%; }

</style>

<script type="text/javascript">
    
    
    
    function insertActivityMedia(table,fId,actId,file,type,path){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) { 
                var id          =   xhttp.responseText; var msg = 'Media uploaded successfully!';
                var content     =   $('#additional_act_media').html();
                content         =   content.replace('add_img_id','act-img-'+id);
                content         =   content.replace('add_del_media_id','del-act-media-'+id);
                content         =   content.replace('add_src_url','{{url("/storage")}}'+path+'/'+file);
                $('#activity-medias').append(content);
                $('.statusMsg').show(); 
                $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
          }
        };
        xhttp.open("GET", '{{url("/admin/course/upload/media/")}}?cId='+actId+'&file='+file+'&type='+type+'&table='+table+'&field_id='+fId+'&path='+path, true);
        xhttp.send('cId='+actId+'&file='+file+'&type='+type+'&table='+table+'&field_id='+fId+'&path='+path);
    }
</script>
