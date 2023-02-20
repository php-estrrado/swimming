<div class="course-media">
    <div class="d-flex flex-row-reverse mb-2">
        <div class="p-2"> 
           
        </div>
    </div>
    <div id="course-medias" class="row">
        @if($medias) 
            @foreach($medias as $media) 
                @php if($media->active == 1){ $active = "Active"; $ckd = true; }else{ $active = "Inactive"; $ckd = false; } @endphp
                <div id="img-{{$media->id}}" class="col-md-3 col-sm-6 mb-2">
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


                   