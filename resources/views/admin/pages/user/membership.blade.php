@extends('admin.layouts.app')
@section('title', 'Membership')
@section('content')
<?php
$na = "";
$currency_name = getCurrencyName();
$name = ($membership) ? $membership->name : $na;
$staff = ($membership) ? $membership->staff : 0;
$desc = ($membership) ? $membership->description : $na;
$status = ($membership) ? $membership->active : 1;
?>
<script type="text/javascript" src="{{asset('public/bizzadmin/assets/js/tinymce.min.js')}}"></script>
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/users/memberships')}}">Memberships</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0"><?php echo $title ?></h2>
                </div>
                <div class="card-body">
                    {{ Form::open(array('url' => "admin/users/membership/save", 'id' => 'membershipform', 'name' => 'membershipform', 'class' => '')) }}
                    <input type="hidden" name="mid" id="mid" value="<?php echo $id ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('name', 'Name', ['class' => 'control-label']) }}
                                <?php echo Form::text('name', $name, ['class' => 'form-control']) ?>
                                @if ($errors->has('name'))
                                <span class="error">{{ $errors->first('name') }}</span>
                                @endif
                                <span id="name_err" class="error"></span>
                            </div>
                        </div>

                        <?php
                        if ($validities) {
                            $i = 1;
                            foreach ($validities as $validity) {
                                if ($validity->mvid != 1) {

                                    $chkchecked = "";
                                    $readonly = 'readonly="readonly"';

                                    if (array_key_exists("price", $validity)) {
                                        $price = $validity->price;
                                        if ($price != 0) {
                                            $chkchecked = 'checked="checked"';
                                            $readonly = "";
                                        }
                                    } else {
                                        $price = 0;
                                    }

                                    if (array_key_exists("mpid", $validity)) {
                                        $mpid = $validity->mpid;
                                    } else {
                                        $mpid = 0;
                                    }
                                    ?>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="col-md-1 float-left chkbx">
                                                <div class="custom-control custom-checkbox mb-3">
                                                    <input <?php echo $chkchecked; ?> class="custom-control-input validity" name="validity<?php echo $i; ?>" id="validity<?php echo $i; ?>" type="checkbox">
                                                    <label class="custom-control-label" for="validity<?php echo $i; ?>"></label>
                                                </div>
                                            </div>
                                            <div class="col-md-11 float-right label">
                                                {{ Form::label('price', $validity->validity_type.' Price ('.$currency_name.')', ['class' => 'control-label']) }}
                                            </div>
                                            <input <?php echo $readonly; ?> type="text" class="form-control" name="price[]" id="price<?php echo $i; ?>" value="{{$price}}" onkeypress="return isNumber(event)" onpaste="return false;">
                                            @if ($errors->has('price'))
                                            <span class="error">{{ $errors->first('price<?php echo $i; ?>') }}</span>
                                            @endif
                                            <span id="price_err<?php echo $i; ?>" class="error"></span>
                                        </div>
                                        <input type="hidden" name="mpid<?php echo $i; ?>" id="mpid<?php echo $i; ?>" value="{{$mpid}}">
                                        <input type="hidden" name="validity_id<?php echo $i; ?>" id="validity_id<?php echo $i; ?>" value="{{$validity->id}}">
                                    </div>
                                    <?php
                                    $i++;
                                }
                            }
                        }
                        ?>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('staff', 'No of Staff', ['class' => 'control-label']) }}
                                <input type="text" class="form-control" name="staff" id="staff" value="{{$staff}}" onkeypress="return isNumber(event)" onpaste="return false;">
                                @if ($errors->has('staff'))
                                <span class="error">{{ $errors->first('staff') }}</span>
                                @endif
                                <span id="staff_err" class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('desc', 'Description', ['class' => 'control-label']) }}
                                <?php echo Form::textarea('desc', $desc, ['class' => 'form-control editor', 'rows' => 3]) ?>
                                @if ($errors->has('desc'))
                                <span class="error">{{ $errors->first('desc') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                                <?php echo Form::select('status', [0 => 'Disable', 1 => 'Enable'], $status, ['class' => 'form-control']) ?>
                                @if ($errors->has('status'))
                                <span class="error">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                            <?php if ($id == 0) { ?>
                                <input type="hidden" name="status" id="status" value="1">
                            <?php } ?>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-md-12 ">
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                            <button id="cancelbtn" type="button" class="btn btn-default mt-1 mb-1">Cancel</button>
                            {{ Form::button('Save', array('class' => 'btn btn-primary', 'type' => 'submit')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .chkbx {
        line-height: 0;
        padding-left: 0
    }
    .label {
        line-height: 30px;
        padding-left: 0
    }
</style>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        var baseurl = $("#baseurl").val();

        var mid = $("#mid").val();
        if (mid == 0)
        {
            $("#status").attr("disabled", "disabled");
        }

        tinymce.init({
            selector: '.editor',
            plugins: [
                'advlist autolink lists link charmap hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime nonbreaking save table contextmenu directionality iconfonts',
                'emoticons template paste textcolor colorpicker textpattern toc'
            ],
            toolbar1: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | forecolor backcolor emoticons',
            tinycomments_mode: 'embedded',
            tinycomments_author: '',
            iconfonts_selector: '.fa, .fab, .fal, .far, .fas, .glyphicon',
            forced_root_block: false,
            image_advtab: true,
            relative_urls: false,
            media_poster: false,
            remove_script_host: false,
            document_base_url: baseurl
        });

        $("body").on("click", "#cancelbtn", function () {
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/memberships';
        });

        $(".validity").each(function (index) {
            var mid = $("#mid").val();
            var i = index + 1;
            $("#validity" + i).click(function () {
                if ($(this).is(":checked")) {
                    $("#price" + i).removeAttr("readonly");
                    $("#price" + i).focus();
                } else {
                    if (mid == 'new')
                    {
                        $("#price_err" + i).html("");
                    }
                    $("#price" + i).val(0);
                    $("#price" + i).attr("readonly", "readonly");
                }
            });

        });

        var validator = $("#membershipform").validate({
            ignore: ":hidden",
            rules: {
                name: {
                    required: true,
                    maxlength: 25
                },
                staff: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "The name field is required.",
                    maxlength: "The maximum length for name is 25."
                },
                staff: {
                    required: "The staff field is required."
                }
            },
            submitHandler: function (form, event) {

                var validate = [];
                var sflag = 1;
                var mid = $("#mid").val();

                if ($('input:checkbox').filter(':checked').length < 1 && mid != 0) {
                    swal({
                        title: "Check at least one validity",
                        text: "",
                        type: "warning",
                        timer: 2000
                    });
                    return false;
                } else
                {

                    $(".validity").each(function (index) {
                        var i = index + 1;
                        if ($("#validity" + i).is(":checked")) {
                            var price = $("#price" + i).val();
                            if (price == '' || price == 0)
                            {
                                $("#price_err" + i).html("Price required");
                                validate.push(i);
                            } else
                            {
                                $("#price_err" + i).html("");
                                validate.splice($.inArray(i, validate), 1);
                            }
                        }
                    });

                }

                if (typeof validate !== 'undefined' && validate.length > 0) {

                } else if (sflag != 0)
                {
                    $.blockUI({message: "<h4>Processing...</h4>"});
                    form.submit();
                }
            }
        });

    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script>
@endsection