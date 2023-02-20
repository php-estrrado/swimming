<div class="course-media">
    <div class="d-flex flex-row-reverse mb-2">
        <div class="p-2"> 
            <div id="mediaFile" class="btn btn-primary pull-right" ><span>Upload Image</span></div><span id="status" ></span>
            <div id="error_mediaFile" class="error"></div>
        </div>
    </div>
    <div id="course-medias" class="row">
        @if($medias) 
            @foreach($medias as $media) 
                @php if($media->active == 1){ $active = "Active"; $ckd = true; }else{ $active = "Inactive"; $ckd = false; } @endphp
                <div id="img-{{$media->id}}" class="col-md-3 col-sm-6 mb-2">

                    <div class="col-12 mb-2 fl">
                        <div class=""><i id="del-media-{{$media->id}}" class="fr fa fa-trash del-media media-del ">&nbsp;</i></div>
                    </div>
                    <div class="col-12 mb-2">
                        <img class="course-img" src="{{url('/storage'.$media->file)}}" alt="Course Image" style="width: 100%;" />
                    </div>
                </div>
            @endforeach 
        @else
            <div class="col-12 mb-4">No media found</div>
        @endif
        <div></div>
    </div>
</div>

<div id="additional_media" style="display: none;">
    <div id="add_img_id" class="col-md-3 col-sm-6 mb-2">
        <div class="col-6 mb-2" style="display: none;">
            <label class="custom-switch">
                {{Form::checkbox('active',1,true,['id'=>'add_media_id','class'=>'custom-switch-input media-status-btn'])}}
                <span class="custom-switch-indicator"></span><span class="custom-switch-description" id="add_media_label_id">Active</span>
            </label>
        </div>
        <div class="col-12 mb-2 fl">
            <div class=""><i id="add_del_media_id" class="fr fa fa-trash del-media media-del">&nbsp;</i></div>
        </div>
        <div class="col-12 mb-2">
            <img id="add_src_id" src="add_src_url" alt="Course Image" style="width: 100%;" />
        </div>
    </div>
</div>
   
<script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    $(function(){
        var btnUpload=$('#mediaFile');
        var status=$('#status');
        new AjaxUpload(btnUpload, {
                action: '{{url("/upload-file.php?cId=$id")}}&dir=storage/app/public/Courses/',
                name: 'media',
                onSubmit: function(file, ext){
                         if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext))){ 
            // extension is not allowed 
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
                                insertMedia('course_media','course_id','{{$id}}',resp.file,'image','/app/public/Courses/{{$id}}/');
                        } else{ 
                            $('.statusMsg').show();
                            var msg = 'Media upload failed';
                            $(".statusMsg").html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                            setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                        }
                }
        });

});
    $(document).ready(function(){
        
        $('.media-status-btn').on('click',function(){
            var id          =   this.id.replace('media-active-','');
            var status;
            if($(this).prop('checked') == true){ status = 1; var msg =   'Media activated successfully!'; $('#mediaSL-'+id).html('Active'); }
            else{ status = 0; var msg =   'Media deactivated successfully!'; $('#mediaSL-'+id).html('Inactive');}
            $.ajax({
                 type: 'POST',
                 url: '{{url("/admin/course/update/status")}}',
                 data: {id: id,cId: $('#cId').val(),active: status,table:'course_media'},
                 success: function (data) {
                    $('.statusMsg').show();
                    $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                    setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
                 }
             });
        });
      
        $('body').on('click','.del-media',function(){
            var id      =   this.id.replace('del-media-','');
            var cId     =   'img-'+id
            var status  =   0;
            var url     =   '{{url("/admin/delete/media")}}';
            var smsg    =   'Media deleted successfully!';
            updateStatus(id,cId,status,url,'','delete',smsg,'course_media');
        });
    });
   
    
    function insertMedia(table,fId,cId,file,type,path){ 
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) { 
                var id          =   xhttp.responseText; var msg = 'Media uploaded successfully!';
                var content     =   $('#additional_media').html();
                content         =   content.replace('add_img_id','img-'+id);
                content         =   content.replace('add_media_id','media-active-'+id);
                content         =   content.replace('add_del_media_id','del-media-'+id);
                content         =   content.replace('add_media_label_id','mediaSL-'+id);
                content         =   content.replace('add_src_id','cSrc-'+id);
                content         =   content.replace('add_src_url','{{url("/storage/app/public/Courses/$id")}}/'+file);
                $('#course-medias').append(content);
                $('.statusMsg').show(); 
                $(".statusMsg").html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>'+msg+'</div>');
                setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
          }
        };
        xhttp.open("GET", '{{url("/admin/course/upload/media/")}}?cId='+cId+'&file='+file+'&type='+type+'&table='+table+'&field_id='+fId+'&path='+path, true);
        xhttp.send('cId='+cId+'&file='+file+'&type='+type+'&table='+table+'&field_id='+fId+'&path='+path);
        
    }
</script>
<script src="{{asset('public/bizzadmin/assets/js/ajax-upload/ajaxupload.3.5.js')}}"></script>
                   