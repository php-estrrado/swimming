<div class="form-group">
    <div class="staff-general">
        <div class="row">
            <div class="col-md-4"><div class="row">
                <div class="col-12 mb-2">
                    {{ Form::label('course_code', 'Course Code', ['class' => 'control-label']) }}
                    {{ Form::text('course_code', $course->course_code, ['id'=>'course_code','class' => 'form-control','disabled'=>true]) }}
                </div>
                <div class="col-12 mb-2">
                     {{ Form::label('course_name', 'Course Name', ['class' => 'control-label']) }}
                    {{ Form::text('course_name', $course->course_name, ['id'=>'course_name','class' => 'form-control','disabled'=>true]) }}
                </div>
                <div class="col-12 mb-2">
                    {{ Form::label('location', 'Location', ['class' => 'control-label']) }}
                    {{ Form::text('location', $course->name, ['id'=>'location','class' => 'form-control','disabled'=>true]) }}
                </div>
            </div></div>
            <div class="col-md-8"><div class="row">
                <div class="col-12 mb-2">
                    {{ Form::label('course_desc', 'Description', ['class' => 'control-label']) }}
                    {{ Form::textarea('course_desc', $course->course_desc, ['id'=>'course_desc','class' => 'form-control','rows'=>11,'disabled'=>true]) }}
                </div>
            </div></div>
            <div class="col-4 mb-2">
                {{ Form::label('start_date', 'Start Date', ['class' => 'control-label']) }}
                {{ Form::text('start_date', date('D M Y',strtotime($course->start_date)), ['id'=>'start_date','class' => 'form-control','disabled'=>true]) }}
            </div>
            <div class="col-4 mb-2">
                {{ Form::label('end_date', 'End Date', ['class' => 'control-label']) }}
                {{ Form::text('end_date', date('D M Y',strtotime($course->end_date)), ['id'=>'end_date','class' => 'form-control','disabled'=>true]) }}
            </div>
            <div class="col-4 mb-2">
                {{ Form::label('closing_date', 'Closing Date', ['class' => 'control-label']) }}
                {{ Form::text('closing_date', date('D M Y',strtotime($course->closing_date)), ['id'=>'closing_date','class' => 'form-control','disabled'=>true]) }}
            </div>
        </div>
    </div>
</div>

                   