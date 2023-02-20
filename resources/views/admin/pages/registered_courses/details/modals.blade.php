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
            <div class="modal-body">
                {{ Form::open(array('url' => "admin/milestone/save", 'id' => 'addMsForm', 'name' => 'addMsForm', 'class' => '')) }}
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
                {{ Form::close() }}

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
            <div class="modal-body">
                {{ Form::open(array('url' => "admin/activity/save", 'id' => 'addActForm', 'name' => 'addActForm', 'class' => '')) }}
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
                        <button id="mAct-close-btn" type="button" class="mAct-close-btn btn btn-edit mt-1">Close</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Add/Edit Activity Media Modal Ends-->

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

<style> #act-media-modal{ min-width: 75%; }</style>

