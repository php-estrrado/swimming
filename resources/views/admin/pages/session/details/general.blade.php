<div class="form-group">
    <div class="staff-general">
        <div class="row">
            <div class="col-md-6 mb-2">
                {{ Form::label('activity_code', 'Activity Code', ['class' => 'control-label']) }}
                {{ Form::text('activity_code', $actCode, ['id'=>'activity_code','class' => 'form-control','disabled'=>true]) }}
            </div>
            
            <div class="col-md-6 mb-2">
                {{ Form::label('activity_name', 'Activity Name', ['class' => 'control-label']) }}
                {{ Form::text('activity_name', $actName, ['id'=>'activity_name','class' => 'form-control','disabled'=>true]) }}
            </div>
            <div class="col-md-6 mb-2mb-2">
                {{ Form::label('student', 'Student', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::text('student', $student, ['id'=>'student','class' => 'form-control','disabled'=>true]) }}
            </div>
            <div class="col-md-6 mb-2">
                <div class="row">
                    {{ Form::label('coach', 'Coach', ['class' => 'control-label']) }}
                    {{ Form::text('coach', $coach, ['id'=>'coach','class' => 'form-control','disabled'=>true]) }}
                </div>
            </div>
            <div class="col-md-12 mb-2">
                {{ Form::label('description', 'Description', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::textarea('gen[description]', $description, ['id'=>'description','class' => 'form-control','rows'=>3]) }}
                @if ($errors->has('description')) <span class="error">{{ $errors->first('description') }}</span> @endif
            </div>
            <div class="col-md-12 mb-2">
                {{ Form::label('review', 'Review', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::textarea('gen[review]', $review, ['id'=>'review','class' => 'form-control','rows'=>3]) }}
                @if ($errors->has('review')) <span class="error">{{ $errors->first('review') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2mb-2">
                {{ Form::label('submeted_at', 'Submited On', ['class' => 'control-label']) }}<?php echo $reqd?>
                {{ Form::date('gen[submited_at]', date('Y-m-d',strtotime($submited)), ['id'=>'submited_at','class' => 'form-control','data-val'=>date('Y-m-d'),'max'=>date('Y-m-d')]) }}
                @if ($errors->has('submited_at')) <span class="error">{{ $errors->first('submited_at') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2">
                <div class="row">
                    {{ Form::label('act_status', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('gen[act_status]',['Pending'=>'Pending','Approved'=>'Approve','Rejected'=>'Reject'], $status, ['id'=>'act_status','class' => 'form-control']) }}
                </div>
            </div>
           
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
//        $('#submeted_at').on('click',function(){
//            $(this).attr('max',$(this).attr('data-val'));
//        });
//        $('#submeted_at').on('blur',function(){
//            $(this).removeAttr('max');
//        });
    });
</script>

                   