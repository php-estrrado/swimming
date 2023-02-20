<div class="form-group">
        <div class="d-flex flex-row-reverse mb-2">
            <div class="p-2"></div>
        </div>
    <div class="course-ms">
        @if($milestones) 
            @foreach($milestones as $ms) 
                @php 
                    if($ms->active == 1){ $active = "Active"; $ckd = true; }else{ $active = "Inactive"; $ckd = false; } 
                    $activities = $ms->activities; $msId = $ms->id;
                @endphp
                <div id="ms-{{$ms->id}}" class="ms-container">
                    <div id="ms-title-{{$ms->id}}" data-toggle="off" class="ms-title" onclick="openTab(this)">
                        <div class="col-12">{{$ms->ms_name}}</div>
                        <div class="clr"></div>
                    </div>
                    <div id="ms-content-{{$msId}}" class="ms-content">
                        <div id="activity-content-{{$msId}}">@include('admin.pages.registered_courses.details.activities')</div>
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
@include('admin.pages.registered_courses.details.modals')

<style>
    
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $('#ms-close-btn').on('click',function(){ $("#addMilestone").modal("hide"); });
        $('body').on('click','mAct-close-btn',function(){ $("#actMediaContent").modal("hide"); });
        
        $('i.edit-ms').on('click',function(){ 
            var id      =   this.id;
            var status  = $('#ms-status-'+this.id).val(); 
            $('#msId').val(this.id); $("#edit-ms-active").val($('#ms-status-'+id).val()); $('#ms_name').val($('#ms_name-'+id).val());
            $('#error_ms_name').html(''); $('#ms-title').html('Edit Milestone');
            $("#addMilestone").modal("show"); 
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
        $('#mAct-close-btn').on('click',function(){ $('#addActivityMedia').modal('hide'); });
        
        $('body').on('click','.edit-media',function(){
            $('#mActId').val(this.id); $("#addActivityMedia").modal("show"); 
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/registered/activity/medias")}}',
                 beforeSend: function () {
                     $('#actMediaContent').html('Loading data ...');
                 },
                 data: {id: this.id},
                 success: function (data) { 
                     $('#actMediaContent').html(data);
                 }
             });
        });
        
   
        
    });

    function openTab(tab){
        var id       =   tab.id.replace('ms-title-','');   
        if($('#'+tab.id).attr('data-toggle') == 'off'){
            $('.ms-content').slideUp('slow'); $("#ms-content-"+id).slideDown();
            $('.ms-title').removeClass('active'); $(tab).addClass('active');
            $('.ms-title').attr('data-toggle','off'); $('#'+tab.id).attr('data-toggle','on');
        }else{ $('.ms-content').slideUp('fast'); $('.ms-title').removeClass('active'); $('#'+tab.id).attr('data-toggle','off'); }
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
</script>
                   