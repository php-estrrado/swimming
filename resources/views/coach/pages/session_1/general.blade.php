<div class="form-group">
    <div class="staff-general">
        <div class="row">
            <div class="col-md-4 mb-2">
                {{ Form::label('course_code', 'Course ID', ['class' => 'control-label']) }}
                {{ Form::text('course_code', $courseCode, ['class' => 'form-control','readonly'=>'readonly']) }}
            </div>
            <div class="col-md-4 mb-2">
                {{ Form::label('course_name', 'Course Name', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::text('gen[course_name]', $courseName ,['id'=>'course_name','class' => 'form-control']) }}
                @if ($errors->has('course_name')) <span class="error">{{ $errors->first('course_name') }}</span> @endif
            </div>
            
            <div class="col-md-4 mb-2">
                {{ Form::label('location', 'Location', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::text('gen[location]', $location, ['id'=>'location','class' => 'form-control']) }}
                @if ($errors->has('location')) <span class="error">{{ $errors->first('location') }}</span> @endif
            </div>
            <div class="col-md-4 mb-2mb-2">
                {{ Form::label('phone', 'Coach Name', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::text('gen[coach]', $coach, ['id'=>'coach','class' => 'form-control']) }}
                @if ($errors->has('coach')) <span class="error">{{ $errors->first('coach') }}</span> @endif
            </div>
            <div class="col-md-4 mb-2">
                {{ Form::label('course_desc', 'Address Line1', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::text('gen[course_desc]', $desc, ['id'=>'address1','class' => 'form-control']) }}
                @if ($errors->has('course_desc')) <span class="error">{{ $errors->first('course_desc') }}</span> @endif
            </div>
            <div class="col-md-4 mb-2">
                {{ Form::label('start_date', 'Start Date', ['class' => 'control-label']) }}
                {{ Form::date('gen[start_date]', $startDate,['id'=>'start_date','class' => 'form-control','min'=>date('Y-m-d')]) }}
            </div>
            <div class="col-md-4 mb-2">
                {{ Form::label('end_date', 'End Date', ['class' => 'control-label']) }}
                {{ Form::date('gen[end_date]', $startDate,['id'=>'end_date','class' => 'form-control','min'=>date('Y-m-d')]) }}
            </div>
            <div class="col-md-4 mb-2">
                {{ Form::label('closing_date', 'Closing Date', ['class' => 'control-label']) }}
                {{ Form::date('gen[closing_date]', $startDate,['id'=>'closing_date','class' => 'form-control','min'=>date('Y-m-d')]) }}
            </div>
            <div class="col-md-4 mb-2">
                {{ Form::label('active', 'Status', ['class' => 'control-label']) }}
                {{ Form::select('gen[active]', [1=>'Active',0=>'Inactive'],$status,['id'=>'active','class' => 'form-control']) }}
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
                   