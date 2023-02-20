<div class="course-media">
    <div id="course-medias" class="row">
        @if($medias) 
            @foreach($medias as $label=>$data) 
            <?php // echo '<pre>'; print_r($medias); echo '</pre>'; DIE; ?>
            @if($data)
            <div class="col-12"><h4>{{$label}}</h4></div>
                @foreach($data as $media) 
                    <div class="col-md-3 col-sm-6 mb-2">
                        @php if($label == 'images'){ @endphp
                            <div class="col-12 mb-2">
                                <img class="course-img" src="{{url('/storage'.$media->file)}}" alt="Course Image" style="width: 100%;" />
                            </div>
                        @php }else{ @endphp
                            <div class="col-12 mb-2">
                                <video width="100%" height="auto" controls>
                                    <source src="{{url('/storage'.$media->file)}}" type="video/mp4">
                                </video>
                            </div>
                        @php } @endphp
                    </div>
                @endforeach 
            @endif
            @endforeach 
        @else
            <div class="col-12 mb-4">No media found</div>
        @endif
        <div></div>
    </div>
</div>

