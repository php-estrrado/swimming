@extends('coach.layouts.app')
@section('title', 'Student Activities')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('coach')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/courses')}}">Courses</a></li>
        <li class="breadcrumb-item"><a href="{{url('coach/course/'.$id)}}">{{$courseName}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">{{$title}}</h2>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="course-ms">
                        @if(count($activities) > 0)
                            <?php echo '<pre>'; print_r($activities); echo '</pre>'; ?>
                            
                        @else
                        <div class="no-rec-container">
                            <div class="no-record tac">No records found.</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
            $('#msId').val(this.id); $("#edit-ms-active").val($('#ms-status-'+id).val()); $('#ms_name').val($('#ms_name-'+id).val());
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

        $('#addMsForm').on('submit',function(){
            if($('#ms_name').val() == ''){ $('#error_ms_name').html('Milestone fiels is required'); return false; }else{ $('#error_ms_name').html(''); }
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
            $('#actId').val(0);$('#act-title').html('Add Activity'); $("#addActivity").modal("show"); $('#activity_name').val('');
             $('#error_act_name').html(''); $('#act-title').html('Add Activity');  var msId = $('#'+this.id).attr('data-id'); $('#msId').val(msId); 
             
        });
        
        $('body').on('click','i.edit-act',function(){
            var id      =   this.id;
            var name    =   $('.ms-content #act_name-'+id).val(); var desc  = $('.ms-content #act_desc-'+id).val(); 
            var status  = $('.ms-content #act_status-'+id).val(); var msId  = $('.ms-content #act_msId-'+id).val(); 
            $('#msId').val(msId); $('#actId').val(id);  $('#activity_name').val(name);  $('#activity_desc').val(desc);  $('#edit-act-active').val(status);
            
            $('#error_act_namw').html(''); $('#error_act_desc').html(''); $('#act-title').html('Edit Activity');
            $("#addActivity").modal("show");
        });
        
        $('#act-close-btn').on('click',function(){ $("#addActivity").modal("hide"); });
        $('#mAct-close-btn').on('click',function(){ $("#addActivityMedia").modal("hide"); });
        
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
            if($('#activity_name').val() == ''){ $('#error_act_name').html('Activity Name fiels is required'); res = false;; }else{ $('#error_act_name').html(''); }
            if($('#activity_desc').val() == ''){ $('#error_act_desc').html('Description fiels is required'); res = false;; }else{ $('#error_act_desc').html(''); }
            if(res == false){ return false; }
            var msg; if($('#msId').val() == 0){ msg = 'Activity added successfilly!'; }else{  msg = 'Activity updated successfilly!'; }
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
                 url: '{{url("/coach/activity/medias")}}',
                 beforeSend: function () {
                     $('#actMediaContent').html('Loading data ...');
                 },
                 data: {id: this.id},
                 success: function (data) { 
                     $('#actMediaContent').html(data);
                 }
             });
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
            var msId        =   $(this).attr('data-id');    var id  =   this.id;
            $('#groupForm #ms_id').val(msId); $('#groupForm #group_id').val(id); 
            $('#groupForm #group_name').val($(this).attr('data-name')); $('#groupForm #active').val($(this).attr('data-status')); 
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
    });

    function openTab(tab){
        var id       =   tab.id.replace('ms-title-','');   
        if($('#'+tab.id).attr('data-toggle') == 'off'){
            $('.ms-content').slideUp('slow'); $("#ms-content-"+id).slideDown();
            $('.ms-title').removeClass('active'); $(tab).addClass('active');
            $('.ms-title').attr('data-toggle','off'); $('#'+tab.id).attr('data-toggle','on');
        }else{ $('.ms-content').slideUp('fast'); $('.ms-title').removeClass('active'); $('#'+tab.id).attr('data-toggle','off'); }
        togleTab('activity-tab-'+id,id);
    }
    
    function openGrTab(tab){
        var id       =   tab.id.replace('gr-title-','');    
        if($('#'+tab.id).attr('data-toggle') == 'off'){
            $('.gr-content').slideUp('slow'); $("#gr-content-"+id).slideDown();
            $('.gr-title').removeClass('active'); $(tab).addClass('active');
            $('.gr-title').attr('data-toggle','off'); $('#'+tab.id).attr('data-toggle','on');
        }else{ $('.gr-content').slideUp('fast'); $('.gr-title').removeClass('active'); $('#'+tab.id).attr('data-toggle','off'); }
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
                            var msg = 'Milestone deleted successfully!'; $('#'+cId).hide(1000);
                            $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
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
@endsection('content')                 