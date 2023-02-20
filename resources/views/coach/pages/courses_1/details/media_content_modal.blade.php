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
    @else
    <div class="col-md-12 "><div id="no-act-media" class="no-rec-container tac"> No media found.</div></div>
    @endif
</div>

