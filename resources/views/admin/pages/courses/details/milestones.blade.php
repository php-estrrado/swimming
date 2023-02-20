<div class="form-group">
        <div class="d-flex flex-row-reverse mb-2">
            <div class="p-2">{{ Form::button('Add Milestone', array('id'=>'add_ms_btn','class' => 'btn btn-primary pull-right addMs_btn', 'type' => 'button')) }} </div>
        </div>
    <div class="course-ms">
        @if($milestones) 
            @foreach($milestones as $ms) 
                @php 
                    if($ms->active == 1){ $active = "Active"; $ckd = true; }else{ $active = "Inactive"; $ckd = false; } 
                    $activities = $ms->activities;$groups = $ms->groups;  $msId = $ms->id;
                @endphp
                <div id="ms-{{$ms->id}}" class="ms-container">
                    <div id="ms-title-{{$ms->id}}" data-toggle="off" class="ms-title">
                        <div class="col-12 col-md-9 fl" style="cursor: pointer" onclick="openTab('ms-title-{{$ms->id}}')">{{$ms->ms_name}}</div>
                        <div class="col-6 col-md-2 fl">
                            <label class="custom-switch">
                                {{Form::checkbox('active',1,$ckd,['id'=>'active-'.$ms->id,'class'=>'custom-switch-input ms-status-btn'])}}
                                <span class="custom-switch-indicator"></span><span class="custom-switch-description" id="msSL-{{$ms->id}}">{{$active}}</span>
                            </label>
                        </div>
                        <div class="col-6 col-md-1 fr">
                            {{Form::hidden('ms_name-'.$ms->id,$ms->ms_name,['id'=>'ms_name-'.$ms->id])}}
                            {{Form::hidden('ms-status-'.$ms->id,$ms->active,['id'=>'ms-status-'.$ms->id])}}
                            <div class="fl link"><i id="{{$ms->id}}" title="Edit Milestone" class="edit-ms fa fa-edit"></i></div>
                            <div class="fl link"><i id="{{$ms->id}}" title="Delete Milestone" class="del-ms fa fa-trash"></i></div>
                        </div>
                        <div class="clr"></div>
                    </div>
                    <div id="ms-content-{{$msId}}" class="ms-content">
                        <div id="act-tab" class="">
                            <ul class="nav nav-tabs">
                               <li id="activity-tab-{{$msId}}" data-id="{{$msId}}" class="active"><a data-toggle="tab" href="#activities">Activities</a></li>
                                <li id="act-group-tab-{{$msId}}" data-id="{{$msId}}"><a data-toggle="tab" href="#media">Activity Group</a></li> 
                           </ul>
                        </div>
                        <div id="activity-content-{{$msId}}" class="activity-content">
                            <div class="col-12 tab-pane active" id="content-activity-tab-{{$msId}}">
                                @include('admin.pages.courses.details.activities')
                            </div>
                        
                            <div class="col-12 tab-pane" id="content-act-group-tab-{{$msId}}">
                                <div class="d-flex flex-row-reverse add-gr-btn">
                                    <div class="p-2">{{ Form::button('Add Group', array('id'=>'add_group_btn-'.$msId,'class'=>'btn btn-primary pull-right addGroup_btn','type'=>'button','data-id'=>$msId)) }} </div>
                                </div>
                                <div id="content-act-group-tab-content-{{$msId}}">
                                    @include('admin.pages.courses.details.activity_groups')
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            @endforeach
        @else
        <div class="no-rec-container">
            <div class="no-record tac">No records found.</div>
        </div>
        @endif
    </div>
</div>
@include('admin.pages.courses.details.modals')

<style>
    
</style>
<script type="text/javascript">
    $(document).ready(function(){
       // $('.ms-content').hide();
//        $('body').on('click','.ms-title',function(){ 
//            var id       =   this.id.replace('ms-title-','');
//            $('.ms-content').slideUp('fast'); $("#ms-content-"+id).slideDown();
//            $('.ms-title').removeClass('active'); $(this).addClass('active');
//        });

        $('#add_ms_btn').on('click',function(){ 
            $('#msId').val(0); $("#addMilestone").modal("show");$('#ms_name').val(''); $('#error_ms_name').html('');  
            $('#ms-title').html('Add Milestone');
        });
        $('#ms-close-btn').on('click',function(){ $("#addMilestone").modal("hide"); });
        
        $('i.edit-ms').on('click',function(){ 
            var id      =   this.id;
            var status  = $('#ms-status-'+this.id).val(); 
            var active  =   1; 
            if($('#active-'+this.id).prop('checked') == false) active = 0; 
            $('#msId').val(this.id); $("#edit-ms-active").val(active); $('#ms_name').val($('#ms_name-'+id).val());
            $('#error_ms_name').html(''); $('#ms-title').html('Edit Milestone');
            $("#addMilestone").modal("show"); 
        });
        
        $('.ms-status-btn').on('click',function(){
            var id          =   this.id.replace('active-','');
            var status;
            if($(this).prop('checked') == true){ status = 1; var msg =   'Milestone activated successfully!'; $('#msSL-'+id).html('Active'); }
            else{ status = 0; var msg =   'Milestone deactivated successfully!'; $('#msSL-'+id).html('Inactive'); }
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/course/update/status")}}',
                 data: {id: id,cId: $('#cId').val(),active: status,table:'course_milestones'},
                 success: function (data) {
                    $('.statusMsg').show();
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                 }
             });
        });
        
        $('.gr-status-btn').on('click',function(){
            var id          =   this.id.replace('gr-active-','');
            var status;
            if($(this).prop('checked') == true){ status = 1; var msg =   'Group activated successfully!'; $('#grSL-'+id).html('Active'); }
            else{ status = 0; var msg =   'Group deactivated successfully!'; $('#grSL   -'+id).html('Inactive'); }
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/course/update/status")}}',
                 data: {id: id,cId: $('#cId').val(),active: status,table:'course_activity_groups'},
                 success: function (data) {
                    $('.statusMsg').show();
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                 }
             });
        });

        $('#addMsForm').on('submit',function(){
            if($('#ms_name').val() == ''){ $('#error_ms_name').html('Milestone files is required'); return false; }else{ $('#error_ms_name').html(''); }
            var msg; if($('#msId').val() == 0){ msg = 'Milestone added successfilly!'; }else{  msg = 'Milestone updated successfilly!' }
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/milestone/save")}}',
                 beforeSend: function () {
                     $("#addMilestone").modal("hide"); 
                 },
                 data: {id: $('#msId').val(),cId: $('#cId').val(),ms_name: $('#ms_name').val(),active: $('#edit-ms-active').val()},
                 success: function (data) {
                     $('#ms-tab-content').html(data);
                     $('.statusMsg').show();
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                 }
             });
             return false;
        });
        
        
        $('body').on('click','.addAct_btn',function(){
            $('#actId').val(0);$('#act-title').html('Add Activity'); $('#activity_name').val('');  $('#activity_desc').val('');  $('#edit-act-active').val(1);
            $("#addActivity").modal("show"); $('#activity_name').val(''); $('#error_act_name').html(''); $('#error_act_desc').html('');
            $('#act-title').html('Add Activity');  var msId = $('#'+this.id).attr('data-id'); $('#msId').val(msId); 
             
        });
        
        $('body').on('click','i.edit-act',function(){
            var id      =   this.id;
            var active  =   1; 
            var msId    =   $('#act_msId-'+id).val(); 
            var name    =   $('.ms-content #act_name-'+id).val(); var desc  = $('.ms-content #act_desc-'+id).val(); 
            if($('#act-status-'+id).prop('checked') == false) active = 0; 
            $('#msId').val(msId); $('#actId').val(id);  $('#activity_name').val(name);  $('#activity_desc').val(desc);  $('#edit-act-active').val(active);
            
            $('#error_act_name').html(''); $('#error_act_desc').html(''); $('#act-title').html('Edit Activity');
            $("#addActivity").modal("show");
        });
        
        $('#act-close-btn').on('click',function(){ $("#addActivity").modal("hide"); });
        
        $('body').on('click','.act-status-btn',function(){
            var id          =   this.id.replace('act-status-','');
            var status;
            if($(this).prop('checked') == true){ status = 1; var msg =   'Actinity activated successfully!'; $('#actSL-'+id).html('Active'); }
            else{ status = 0; var msg =   'Actinity deactivated successfully!'; $('#actSL-'+id).html('Inactive'); }
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/course/update/status")}}',
                 data: {id: id,cId: $('#cId').val(),active: status,table:'course_acivities'},
                 success: function (data) {
                    $('.statusMsg').show();
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                 }
             });
        });
        
        $('#addActForm').on('submit',function(){
            var res = true;
            if($('#activity_name').val() == ''){ $('#error_act_name').html('Activity Name field is required'); res = false;; }else{ $('#error_act_name').html(''); }
            if($('#activity_desc').val() == ''){ $('#error_act_desc').html('Description field is required'); res = false;; }else{ $('#error_act_desc').html(''); }
            if(res == false){ return false; }
            var msg; if($('#actId').val() == 0){ msg = 'Activity added successfilly!'; }else{  msg = 'Activity updated successfilly!'; }
            var msId = $('#msId').val(); $("#addActivity").modal("hide");
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/activity/save")}}',
                 beforeSend: function () {
                     $("#addMilestone").modal("hide"); 
                 },
                 data: {id: $('#actId').val(),ms_id: $('#msId').val(),cId: '{{$id}}',act_name: $('#activity_name').val(),act_desc: $('#activity_desc').val(),active: $('#edit-act-active').val()},
                 success: function (data) { 
                     $('#content-activity-tab-'+msId).html(data);
                     $('.statusMsg').show();
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                 }
             });
             return false;
        });
        
        $('body').on('click','.edit-media',function(){
            $('#mActId').val(this.id); $("#addActivityMedia").modal("show"); 
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/activity/medias")}}',
                 beforeSend: function () {
                     $('#actMediaContent').html('Loading data ...');
                 },
                 data: {id: this.id},
                 success: function (data) { 
                     $('#actMediaContent').html(data);
                 }
             });
        });
        
//        $('body').on('click','.del-ms',function(){
//            var id      =   this.id;
//            $.ajax({
//                 type: 'POST',
//                 url: '{{url("/admin/course/disable")}}',
//                 data: {id: id,table: 'course_milestones',noPage: 1},
//                 success: function (data) { 
//                    $('.statusMsg').show(); 
//                    var msg = 'Milestone deleted successfully!'; $('#ms-'+id).hide(1000);
//                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
//                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
//                    
//                 }
//             });
//        });
        
        $("body").on("click", ".del-ms", function () { 
            var cId     =   'ms-'+this.id
            var id      =   this.id;
            var status  =   0;
            var url     =   '{{url("/admin/course/disable")}}';
            var smsg    =   'Milestone deleted successfully!';
            updateStatus(id,cId,status,url,'','delete',smsg,'course_milestones');
        });
        
        $('body').on('click','.del-act',function(){
            var cId     =   'act-'+this.id
            var id      =   this.id;
            var status  =   0;
            var url     =   '{{url("/admin/course/disable")}}';
            var smsg    =   'Activity deleted successfully!';
            updateStatus(id,cId,status,url,'','delete',smsg,'course_acivities');
        });
        
        $('body').on('click','#group-close-btn',function(){ $('#addNewGRoup').modal('hide'); });
        $('body').on('click','.addGroup_btn',function(){
            var id      =   this.id.replace('add_group_btn-',''); $('#groupForm #ms_id').val(id); $('#groupForm #group_id').val(0); 
            $('#groupForm #group_name').val(''); $('#groupForm #active').val(1); 
            $('#group-title').html('Add Group'); $('#addNewGRoup').modal('show');
            $('#gr-model-activities').html('<div style="text-align: center;"><img height="60" src="{{asset('public/coach/assets/img/ajax-loader.gif')}}" alt="Loading..." /></div>');
            getActivities(id,0);
        });
        
        $('body').on('click','.edit-group',function(){
            var msId        =   $(this).attr('data-id');    var id  =   this.id; var active = 1;
            if($('#gr-active-'+id).prop('checked') == false){ active = 0; }
            $('#groupForm #ms_id').val(msId); $('#groupForm #group_id').val(id); 
            $('#groupForm #group_name').val($(this).attr('data-name')); $('#groupForm #gr_active').val(active); 
            $('#group-title').html('Edit Group'); $('#addNewGRoup').modal('show');
            $('#gr-model-activities').html('<div style="text-align: center;"><img height="60" src="{{asset('public/coach/assets/img/ajax-loader.gif')}}" alt="Loading..." /></div>');
            getActivities(msId,id);
        });
        
        $('body').on('submit','#groupForm',function(){ 
            if($('#groupForm #group_name').val() == ''){ $('#error_group_name').html('Group Name field is reqiured'); return false; }
            else{ $('#error_group_name').html(''); }
            var msId    = $('#groupForm #ms_id').val();
            $.ajax({
                 type: 'POST',
                 url: $(this).attr('action'),
                 data: $(this).serialize(),
                 beforeSend: function () {
                   //  $('#actMediaContent').html('Loading data ...');
                 },
                 success: function (data) { 
                    $('#content-act-group-tab-content-'+msId).html(data); $('#addNewGRoup').modal('hide');
                    if($('#groupForm #group_id').val() > 0){ var msg = 'Group updated successfully!'; }else{ var msg = 'Group added successfully!'; }
                    $('.statusMsg').show(); 
                    $(".statusMsg").html('<div class="alert alert-success" alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                     
                 }
             });
             return false; 
        });
        
        $('body').on('click','.del-group',function(){ 
            var id      =   this.id;
            var rowId   =   'group-'+id;
            var url     =   '{{url("admin/course/group/delete")}}';
            var smsg    =   'Group deleted successfully';
            updateStatus(id,rowId,0,url,'group-','delete_group',smsg,'course_activity_groups');
        });
    });

    function openTab(tab){
        var id       =   tab.replace('ms-title-','');   
        if($('#'+tab).attr('data-toggle') == 'off'){
            $('.ms-content').slideUp('slow'); $("#ms-content-"+id).slideDown();
            $('.ms-title').removeClass('active'); $(tab).addClass('active');
            $('.ms-title').attr('data-toggle','off'); $('#'+tab).attr('data-toggle','on');
        }else{ $('.ms-content').slideUp('fast'); $('.ms-title').removeClass('active'); $('#'+tab).attr('data-toggle','off'); }
        togleTab('activity-tab-'+id,id);
    }
    
    function openGrTab(tab){
        var id       =   tab.replace('gr-title-','');    
        if($('#'+tab).attr('data-toggle') == 'off'){
            $('.gr-content').slideUp('slow'); $("#gr-content-"+id).slideDown();
            $('.gr-title').removeClass('active'); $('#'+tab).addClass('active');
            $('.gr-title').attr('data-toggle','off'); $('#'+tab).attr('data-toggle','on');
        }else{ $('.gr-content').slideUp('fast'); $('.gr-title').removeClass('active'); $('#'+tab).attr('data-toggle','off'); }
    }
    
    function updateStatus(id,cId,status,url,row,type,smsg,table){ 
        swal({
            title: "Are you sure?",
            text: "",
            type: "info",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm){
                if (id != ''){
                    $.blockUI({message: "<h4>Processing...</h4>"});
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {id: id, active: status,table: table},
                        success: function (data) {
                            $.unblockUI();
                            $('.statusMsg').show(); 
                            if(type == 'delete_group'){ $('#'+cId).css('background-color','red'); $('#'+cId).hide(); }
                            var msg = 'Milestone deleted successfully!'; $('#'+cId).hide(1000);
                            $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+smsg+'</div>');
                            setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                        }
                    });
                } 
            }
        });
    }
    
    function getActivities(msId,grId){
        $.ajax({
            type: "POST",
            url: '{{url("/admin/group/activities")}}',
            data: {ms_id: msId, group_id: grId},
            success: function (data) {
                 $('#gr-model-activities').html(data);
            }
        });
    }
</script>
                   