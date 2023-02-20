<div class="form-group">
    <div class="staff-general">
        <div class="row">
            <div class="col-md-4"><div class="row">
                <div class="col-12 mb-2">
                    {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                    {{ Form::text('name', $name, ['id'=>'name','class' => 'form-control','disabled'=>true]) }}
                </div>
                <div class="col-12 mb-2">
                    {{ Form::label('phone', 'Phone', ['class' => 'control-label']) }}
                    {{ Form::text('phone', $phone, ['id'=>'phone','class' => 'form-control','disabled'=>true]) }}
                </div>
            </div></div>
            <div class="col-md-4"><div class="row">
                <div class="col-12 mb-2">
                    {{ Form::label('email', 'Email', ['class' => 'control-label']) }}
                    {{ Form::text('email', $email, ['id'=>'email','class' => 'form-control','disabled'=>true]) }}
                </div>
                <div class="col-12 mb-2">
                    {{ Form::label('parent_name', 'Parent Name', ['class' => 'control-label']) }}
                    {{ Form::text('parent_name', $parentName, ['id'=>'parent_name','class' => 'form-control','disabled'=>true]) }}
                </div>
            </div></div>
            <div class="col-md-4"><div class="row">
                    <div class="col-12 mb-2">
                        <img id="blah" class="fr" style="width: auto; height: 117px;" src="{{$avthar}}" />
                    </div>
            </div></div>
            <div class="col-md-8 mb-2">
                {{ Form::label('address', 'Address', ['class' => 'control-label']) }}
                {{ Form::textarea('address1', $address1, ['id'=>'address1','class' => 'form-control','rows'=>6,'disabled'=>true]) }}
            </div>
            <div class="col-md-4"><div class="row">
                <div class="col-12 mb-2">
                    {{ Form::label('active_from', 'Active From', ['class' => 'control-label']) }}
                    {{ Form::text('active_from', date('d-m-Y',strtotime($active_from)), ['id'=>'active_from','class' => 'form-control','disabled'=>true]) }}
                </div>
                <div class="col-12 mb-2">
                    {{ Form::label('active', 'Status', ['class' => 'control-label']) }}
                    {{ Form::select('active', [1=>'Active',0=>'Inactive'],$status, ['id'=>'active','class' => 'form-control','disabled'=>true]) }}
                </div>
            </div></div>
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
                   