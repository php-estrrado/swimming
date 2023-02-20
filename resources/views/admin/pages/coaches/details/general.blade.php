<div class="form-group">
    <div class="staff-general">
        <div class="row">
            <div class="col-md-6 mb-2">
                {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                {{ Form::text('name', $name, ['id'=>'name','class' => 'form-control']) }}
                @if ($errors->has('name')) <span class="error">{{ $errors->first('name') }}</span> @endif
            </div>
            
            <div class="col-md-6 mb-2">
                {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                {{ Form::text('email', $email, ['id'=>'email','class' => 'form-control']) }}
                @if ($errors->has('email')) <span class="error">{{ $errors->first('email') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2mb-2">
                {{ Form::label('phone', 'Phone', ['class' => 'control-label']) }}
                {{ Form::text('phone', $phone, ['id'=>'phone','class' => 'form-control']) }}
                @if ($errors->has('phone')) <span class="error">{{ $errors->first('phone') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2">
                {{ Form::label('created_at', 'Created On', ['class' => 'control-label']) }}
                {{ Form::text('created_at', $created_at, ['id'=>'created_at','class' => 'form-control','disabled'=>true]) }}
                @if ($errors->has('created_at')) <span class="error">{{ $errors->first('created_at') }}</span> @endif
            </div>
<!--            <div class="col-md-6 mb-2">
                {{ Form::label('address', 'Address', ['class' => 'control-label']) }}
                {{ Form::textarea('address1', $address1, ['id'=>'address1','class' => 'form-control','rows'=>7]) }}
                @if ($errors->has('address1')) <span class="error">{{ $errors->first('address1') }}</span> @endif
            </div>-->
            <div class="col-md-6 mb-2">
                {{ Form::label('location', 'Location', ['class' => 'control-label']) }}
                {{ Form::select('location', $locations,$location, ['id'=>'location','class' => 'form-control','placeholder'=>'Select Location']) }}
                @if ($errors->has('location')) <span class="error">{{ $errors->first('location') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2">
                {{ Form::label('password', 'Password', ['class' => 'control-label']) }}
                {{ Form::password('password',['id'=>'password','class' => 'form-control', 'autocomplete'=>'new-password']) }}
                @if ($errors->has('password')) <span class="error">{{ $errors->first('password') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2">
                {{ Form::label('address', 'Address', ['class' => 'control-label']) }}
                {{ Form::textarea('address1', $address1, ['id'=>'address1','class' => 'form-control','rows'=>7]) }}
                @if ($errors->has('address1')) <span class="error">{{ $errors->first('address1') }}</span> @endif
            </div>
            <div class="col-md-6 mb-2">
                {{ Form::label('active', 'Status', ['class' => 'control-label']) }}
                {{ Form::select('active', [1=>'Active',0=>'Inactive'],$status, ['id'=>'active','class' => 'form-control']) }}
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
                   