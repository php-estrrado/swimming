 {{ Form::open(array('url' => "admin/student/save", 'id' => 'coachForm', 'name' => 'coachForm', 'class' => '','files'=>'true')) }}
    {{Form::hidden('cId', $id)}}   
    <div class="form-group">
        <div class="staff-general">
            <div class="row">


                <div class="col-md-6 mb-2">
                    {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name', $name, ['id'=>'name','class' => 'form-control']) }}
                    @if ($errors->has('name')) <span class="error">{{ $errors->first('name') }}</span> @endif
                </div>

                <div class="col-md-6 mb-2">
                    {{ Form::label('email', 'Email', ['class' => 'control-label']) }}<?php echo $reqd?>
                    {{ Form::text('email', $email, ['id'=>'email','class' => 'form-control']) }}
                    @if ($errors->has('email')) <span class="error">{{ $errors->first('email') }}</span> @endif
                </div>
                <div class="col-md-6 mb-2">
                    {{ Form::label('phone', 'Phone', ['class' => 'control-label']) }}<?php echo $reqd?>
                    {{ Form::text('phone', $phone, ['id'=>'phone','class' => 'form-control']) }}
                    @if ($errors->has('phone')) <span class="error">{{ $errors->first('phone') }}</span> @endif
                </div>
                <div class="col-md-6 mb-2">
                    {{ Form::label('is_parent', 'Role', ['class' => 'control-label']) }}
                    {{ Form::select('is_parent',['0'=>'Student','1'=>'Parent'],$isParent,['id'=>'is_parent','class' => 'form-control', 'autocomplete'=>'new-password','disabled'=>$roleDisable]) }}
                    @if ($errors->has('is_parent')) <span class="error">{{ $errors->first('is_parent') }}</span> @endif
                </div>
                <div class="col-md-6 mb-2">
                    {{ Form::label('address', 'Address', ['class' => 'control-label']) }}<?php echo $reqd?>
                    {{ Form::textarea('address1', $address1, ['id'=>'address1','class' => 'form-control','rows'=>7]) }}
                    @if ($errors->has('address1')) <span class="error">{{ $errors->first('address1') }}</span> @endif
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            {{ Form::label('created_at', 'Created On', ['class' => 'control-label']) }}
                            {{ Form::text('created_at', $created_at, ['id'=>'created_at','class' => 'form-control','disabled'=>true]) }}
                            @if ($errors->has('created_at')) <span class="error">{{ $errors->first('created_at') }}</span> @endif
                        </div>
                    </div>
                    <div class="col-md-12 mb-2">
                        <div class="row">
                            {{ Form::hidden('parent', 0, ['id'=>'parent']) }}
                            {{ Form::label('active', 'Status', ['class' => 'control-label']) }}
                            {{ Form::select('active', [1=>'Active',0=>'Inactive'],$status, ['id'=>'active','class' => 'form-control']) }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
     <hr />
    <div class="col-md-12 ">
        <div class="d-flex flex-row-reverse">
            <div class="p-2">{{ Form::button('Save', array('class' => 'btn btn-primary pull-right submit_btn', 'type' => 'submit')) }}</div>
            <div class="p-2"><a href="{{url('/admin/user/students')}}">{{ Form::button('Cancel', array('class' => 'btn btn-edit pull-right cancel_btn', 'type' => 'button')) }} </a></div>
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
                   