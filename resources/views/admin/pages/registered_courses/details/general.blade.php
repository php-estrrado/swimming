{{ Form::open(array('url' => "admin/course/save", 'id' => 'courseForm', 'name' => 'courseForm', 'class' => '','files'=>'true')) }}
    {{Form::hidden('cId', $id)}}
    <div class="form-group">
        <div class="course-general">
            <div class="row">
                <div class="col-md-4 mb-2">
                    {{ Form::label('course_code', 'Course ID', ['class' => 'control-label label-name']) }}
                    <div class="label-val">{{$courseCode}}</div>
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('course_name', 'Course Name', ['class' => 'control-label label-name']) }}
                    <div class="label-val">{{$courseName}}</div>
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('location', 'Location', ['class' => 'control-label label-name']) }}
                    <div class="label-val">{{$location}}</div>
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('registered_on', 'Registered On', ['class' => 'control-label label-name']) }}
                    <div class="label-val">{{$registered}}</div>
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('closing_date', 'Closing Date', ['class' => 'control-label label-name']) }}
                            <div class="label-val">{{$closingDate}}</div>
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('active', 'Status', ['class' => 'control-label label-name']) }}
                    <div class="label-val">{{$status}}</div>
                </div>
                <div class="col-md-12 mb-2">
                    {{ Form::label('course_desc', 'Course Description', ['class' => 'control-label label-name']) }}
                    <div class="label-desc">{{$desc}}</div>
                </div>

            </div>
        </div>
    </div>
{{ Form::close() }}  
<style>.staff-general label{ font-size: 11px; line-height: 24px; } </style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#avthar").change(function(){ readURL(this); });
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) { $('#blah').attr('src', e.target.result); $('#blah').show(); }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
                   