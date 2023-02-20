
{{ Form::open(array('url' => "admin/activity/media/save", 'id' => 'addActForm', 'name' => 'addActForm', 'class' => '')) }}
    <div class="p-2 fr"> 
        <div id="actMediaFile" class="btn btn-primary pull-right" ><span>Upload Image</span></div><span id="mediaStatus" ></span>
        <div id="error_act_mediaFile" class="error"></div>
    </div>
    <div class="clr"></div>
    <div id="activity-medias" class="row"> 
        @if(count($medias) > 0) 
            @foreach($medias as $media)
            <div id="act-img-{{$media->id}}" class="col-md-4 col-sm-6 ">
                    <div class="col-12 mb-2 fl">
                        <div class=""><i id="del-act-media-{{$media->id}}" class="fr fa fa-trash media-del del-act-media">&nbsp;</i></div>
                    </div>
                    <div class="col-12 mb-2">
                        <img class="course-img" src="{{url('/storage'.$media->file)}}" alt="Course Image" style="width: 100%;" />
                    </div>
                </div>
            @endforeach 
        @endif
    </div>
{{ Form::close() }}

<script type="text/javascript">
    $(function(){
        var btnUpload=$('#actMediaFile');
        var status=$('#mediaStatus');
        new AjaxUpload(btnUpload, {
                action: '{{url("/upload-file.php")}}?cId='+$('#mActId').val()+'&dir=storage/app/public/Activities/',
                name: 'media',
                onSubmit: function(file, ext){
                         if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
                            alert('Only JPG, PNG or GIF files are allowed');   return false;
                        }
                        status.text('Uploading...');
                },
                onComplete: function(file, response){ 
                    var resp = JSON.parse(response);
                        //On completion clear the status
                        status.text('');
                        //Add uploaded file to list 
                      //  alert(response);
                        if(resp.status==="success"){
                                insertActivityMedia('course_acivity_media','activity_id',$('#mActId').val(),resp.file,'image','/app/public/Activities/'+$('#mActId').val()+'/');
                        } else{ 
                            $('.statusMsg').show();
                            var msg = 'Media upload failed';
                            $(".statusMsg").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                            setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                        }
                }
        });
        $('#mAct-close-btn').on('click',function(){ $('#addActivityMedia').modal('hide'); });
    });
    
    $(document).ready(function(){
      
        $('body').on('click','.del-act-media',function(){
            var id      =   this.id.replace('del-act-media-','');
            var cId     =   'act-img-'+id
            var status  =   0;
            var url     =   '{{url("/admin/delete/media")}}';
            var smsg    =   'Media deleted successfully!';
            updateStatus(id,cId,status,url,'','delete',smsg,'course_acivity_media');
        });
        
    });
</script>
