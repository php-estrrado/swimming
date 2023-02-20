{{ Form::open(array('url' => "admin/course/save", 'id' => 'courseForm', 'name' => 'courseForm', 'class' => '','files'=>'true')) }}
    {{Form::hidden('cId', $id)}}
    <div class="form-group">
        <div class="course-general">
            <div class="row">
                <div class="col-md-4 mb-2">
                    {{ Form::label('course_code', 'Course ID', ['class' => 'control-label']) }}
                    {{ Form::text('course_code', $courseCode, ['class' => 'form-control','readonly'=>'readonly']) }}
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('course_name', 'Course Name', ['class' => 'control-label']) }}
                    {{ Form::text('gen[course_name]', $courseName ,['id'=>'course_name','class' => 'form-control']) }}
                    @if ($errors->has('course_name')) <span class="error">{{ $errors->first('course_name') }}</span> @endif
                </div>

                <div class="col-md-4 mb-2">
                    {{ Form::label('location', 'Location', ['class' => 'control-label']) }}
                    {{ Form::select('gen[location]', $locations,$location, ['placeholder' =>'Select Location','id'=>'location','class' => 'form-control']) }}
                    @if ($errors->has('location')) <span class="error">{{ $errors->first('location') }}</span> @endif
                </div>
                <div class="col-md-8 mb-2">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            {{ Form::label('course_desc', 'Course Description', ['class' => 'control-label']) }}
                            {{ Form::textarea('gen[course_desc]', $desc, ['id'=>'course_desc','class' => 'form-control','rows'=>11]) }}
                            @if ($errors->has('course_desc')) <span class="error">{{ $errors->first('course_desc') }}</span> @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2mb-2">
                    <div class="row">
                        <div class="col-md-12 mb-2">
                            {{ Form::label('start_date', 'Start Date', ['class' => 'control-label']) }}
                            {{ Form::date('gen[start_date]', $startDate,['id'=>'start_date','class' => 'form-control','min'=>date('Y-m-d')]) }}
                            @if ($errors->has('start_date')) <span class="error">{{ $errors->first('start_date') }}</span> @endif
                        </div>
                        <div class="col-md-12 mb-2">
                            {{ Form::label('end_date', 'End Date', ['class' => 'control-label']) }}
                            {{ Form::date('gen[end_date]', $endDate,['id'=>'end_date','class' => 'form-control','min'=>date('Y-m-d')]) }}
                            @if ($errors->has('end_date')) <span class="error">{{ $errors->first('end_date') }}</span> @endif
                        </div>
                        <div class="col-md-12 mb-2">
                            {{ Form::label('closing_date', 'Closing Date', ['class' => 'control-label']) }}
                            {{ Form::date('gen[closing_date]', $closingDate,['id'=>'closing_date','class' => 'form-control','min'=>date('Y-m-d')]) }}
                            @if ($errors->has('closing_date')) <span class="error">{{ $errors->first('closing_date') }}</span> @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('created_at', 'Created On', ['class' => 'control-label']) }}
                    {{ Form::text('gen[created_at]', $created, ['id'=>'created_at','class' => 'form-control','disabled'=>true]) }}
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('coach', 'Coach', ['class' => 'control-label']) }}
                    {{ Form::select('gen[coach]', $coaches,$coach, ['placeholder' =>'Select Coach','id'=>'coach','class' => 'form-control']) }}
                    @if ($errors->has('coach')) <span class="error">{{ $errors->first('coach') }}</span> @endif
                </div>
                <div class="col-md-4 mb-2">
                    {{ Form::label('active', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('gen[active]', [1=>'Active',0=>'Inactive'],$status,['id'=>'active','class' => 'form-control']) }}
                </div>

            </div>
        </div>
    </div>
{{ Form::close() }}  
<style>.staff-general label{ font-size: 11px; line-height: 24px; } </style>
<script type="text/javascript">
    $(document).ready(function(){
        if($('#start_date').val() != ''){ $('#end_date').attr('min',$('#start_date').val()); $('#closing_date').attr('min',$('#start_date').val()); }
        if($('#end_date').val() != ''){ $('#closing_date').attr('max',$('#end_date').val()); }
        
        $('#start_date').on('change',function(){
           $('#end_date').val(''); $('#closing_date').val('');
           $('#end_date').attr('min',this.value); $('#closing_date').attr('min',this.value);
        });
        
        $('#end_date').on('change',function(){
           $('#closing_date').val(''); $('#closing_date').attr('max',this.value);
        });
        
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
                   