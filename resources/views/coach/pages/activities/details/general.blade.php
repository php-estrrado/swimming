<div class="form-group">
    <div class="act-general">
        {{ Form::open(array('url' => "coach/save/activity/review", 'id' => 'reviewForm', 'name' => 'reviewForm', 'class' => '','files'=>'true')) }}
        <div class="row">
            <div class="col-md-4">
                 <div class="col-md-12 mb-2"><div class="row">
                    {{Form::hidden('sId',$activity->id)}}{{Form::hidden('student_id',$activity->student_id)}}
                    {{ Form::label('activity_code', 'Activity Code', ['class' => 'control-label']) }}
                    {{ Form::text('activity_code', $activity->activity_code, ['id'=>'activity_code','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('course_code', 'Course Code', ['class' => 'control-label']) }}
                    {{ Form::text('course_code', $activity->course_code, ['id'=>'course_code','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('ms', 'Milestone', ['class' => 'control-label']) }}
                    {{ Form::text('ms', $activity->ms_name, ['id'=>'ms','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('submited_at', 'Submitted On', ['class' => 'control-label']) }}
                    {{ Form::text('submited_at', date('D M Y',strtotime($activity->submited_at)), ['id'=>'submited_at','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('badge', 'Badge', ['class' => 'control-label']) }}
                    {{ Form::select('badge',$badges, $activity->badge_id, ['id'=>'badge','class' => 'form-control','placeholder'=>'Select Badge','disabled'=>$resp]) }}
                    @if ($errors->has('badge')) <span class="error">{{ $errors->first('badge') }}</span> @endif
                </div></div>
            </div>
            <div class="col-md-4">
                 <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('activity_name', 'Activity Name', ['class' => 'control-label']) }}
                    {{ Form::text('activity_name', $activity->activity_name, ['id'=>'activity_name','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('course_name', 'Course Name', ['class' => 'control-label']) }}
                    {{ Form::text('course_name', $activity->course_name, ['id'=>'course_name','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('student', 'Student', ['class' => 'control-label']) }}
                    {{ Form::text('student', $activity->name, ['id'=>'student','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('reviewed_at', 'Reviewed On Code', ['class' => 'control-label']) }}
                    {{ Form::text('reviewed_at', $activity->reviewed_at, ['id'=>'reviewed_at','class' => 'form-control','disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                    @if($resp)
                    {{ Form::text('status', $activity->status_name, ['id'=>'status','class' => 'form-control','disabled'=>true]) }}
                    @else
                    {{ Form::select('status',[3=>'Approved',4=>'Rejected'], $activity->act_status, ['id'=>'status','class' => 'form-control','placeholder'=>'Select Status']) }}
                    @if ($errors->has('status')) <span class="error">{{ $errors->first('status') }}</span> @endif
                    @endif
                </div></div>
            </div>
            <div class="col-md-4">
                 <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                    {{ Form::textarea('description', $activity->description, ['id'=>'description','class' => 'form-control','rows'=>9,'disabled'=>true]) }}
                </div></div>
                <div class="col-md-12 mb-2"><div class="row">
                    {{ Form::label('coach_review', 'Coach Review', ['class' => 'control-label']) }}
                    {{ Form::textarea('coach_review', $activity->coach_review, ['id'=>'coach_review','class' => 'form-control','rows'=>9,'disabled'=>$resp]) }}
                    @if ($errors->has('coach_review')) <span class="error">{{ $errors->first('coach_review') }}</span> @endif
                </div></div>
            </div>
        </div>
   
    </div>
</div>
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
                   