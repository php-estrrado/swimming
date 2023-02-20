@extends('admin.layouts.app')
@section('title', 'Sms Template')
@section('content')
<?php
$na = "";
$smstitle = ($smstemplate) ? $smstemplate->title : $na;
$identifier = ($smstemplate) ? $smstemplate->identifier : $na;
$description = ($smstemplate) ? $smstemplate->description : $na;
$type = ($smstemplate) ? $smstemplate->type : 1;
$active = ($smstemplate) ? $smstemplate->active : 1;

$readonly = "";
if ($stid != 'new') {
    $readonly = 'readonly="readonly"';
}
?>
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/settings/smstemplates')}}">Sms Templates</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0"><?php echo $title ?></h2>
                    <?php
                    if ($stid != 'new' && sizeof($users) > 0) {
                        ?>
                        <button id="assignusersbtn" class="btn btn-sm btn-primary float-right" data-toggle="modal" data-target="#assignusersModal"><i class="fa fa-check"></i> Assign Users</button>
                    <?php } ?>
                </div>
                <div class="card-body">
                    {{ Form::open(array('url' => "admin/settings/sms/save", 'id' => 'smstemplateform', 'name' => 'smstemplateform', 'class' => '')) }}
                    <input type="hidden" name="id" id="id" value="<?php echo $stid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('title', 'Sms Title', ['class' => 'control-label']) }}
                                <?php echo Form::text('title', $smstitle, ['class' => 'form-control']) ?>
                                @if ($errors->has('title'))
                                <span class="error">{{ $errors->first('title') }}</span>
                                @endif
                                <span id="title_err" class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('identifier', 'Identifier', ['class' => 'control-label']) }}
                                <input type="text" class="form-control" name="identifier" id="identifier" value="{{$identifier}}" <?php echo $readonly; ?>>
                                @if ($errors->has('identifier'))
                                <span class="error">{{ $errors->first('identifier') }}</span>
                                @endif
                                <span id="identifier_err" class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                                <?php echo Form::textarea('description', $description, ['id' => 'description', 'class' => 'form-control editor', 'rows' => 20]) ?>
                                @if ($errors->has('description'))
                                <span class="error">{{ $errors->first('description') }}</span>
                                @endif
                                <span id="description_err" class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                                <?php echo Form::select('status', [0 => 'Disable', 1 => 'Enable'], $active, ['class' => 'form-control']) ?>
                                @if ($errors->has('status'))
                                <span class="error">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
<!--                            <div class="kwrd">
                                <p style="font-weight: bold;">Keywords for Description</p>
                                <?php // foreach ($tempkeywords as $tempkeyword) { ?>
                                    <p><?php // echo $tempkeyword->keyword_label . ": " . $tempkeyword->template_keyword; ?></p>
                                <?php // } ?>
                            </div>-->
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('type', 'Type', ['class' => 'control-label']) }}
                                <?php echo Form::select('type', [1 => 'Admin', 2 => 'Shop'], $type, ['class' => 'form-control']) ?>
                                @if ($errors->has('type'))
                                <span class="error">{{ $errors->first('type') }}</span>
                                @endif
                            </div>
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
<?php
if ($users) {
    ?>
    <!-- Assign Users Modal Starts-->
    <div class="modal fade" id="assignusersModal">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h2 class="modal-title">Assign Users</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">

                    <form id="assignusersform" name="assignusersform" method="POST" action="{{url('admin/settings/sms/assign')}}">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="form-group">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input selectall" name="selectall" id="selectall" type="checkbox" value="1">
                                            <label class="custom-control-label" for="selectall">Select All</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <?php
                                    foreach ($users as $user) {

                                        $checked = "";

                                        if ($shopusers) {
                                            foreach ($shopusers as $shopuser) {
                                                if ($user->uid == $shopuser->user_id) {
                                                    $checked = 'checked="checked"';
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="col-lg-4 col-md-4 col-sm-6 col-12 float-left chkbx">
                                            <div class="custom-control custom-checkbox mb-3">
                                                <input class="checkbox custom-control-input users" <?php echo $checked; ?> name="users[]" id="user-<?php echo $user->uid; ?>" type="checkbox" value="<?php echo $user->uid; ?>">
                                                <label class="custom-control-label" for="user-<?php echo $user->uid; ?>"><?php echo $user->company_name; ?></label>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                            {{ csrf_field() }}
                            <div class="col-md-12 ">
                                <input type="hidden" name="smsid" id="smsid" value="<?php echo $stid; ?>">
                                <input type="hidden" name="formtype" id="formtype" value="1">
                                <button id="assign-btn" name="assign" type="submit" class="modal-btn btn btn-primary mt-1 mb-1" value="assign">Assign</button>
                                <button id="unassign-btn" name="unassign" type="submit" class="modal-btn btn btn-primary mt-1 mb-1" value="unassign">Unassign all users</button>
                            </div>
                        </div>
                    </form>

                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>

            </div>
        </div>
    </div>
    <!-- Assign Users Ends-->
<?php } ?>

<style>
    .close {
        margin-top: -5px !important;
        margin-right: 0px  !important;
    }
    .modal-btn {
        float: right;
    }
    #assign-btn {
        margin-left: 10px;
    }
    .kwrd p {
        font-size: 13px;
    }
</style>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $("body").on("click", "#cancelbtn", function () {
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/settings/smstemplates';
        });

        var validator = $("#smstemplateform").validate({
            ignore: ":hidden",
            rules: {
                title: {
                    required: true,
                    maxlength: 150
                },
                identifier: {
                    required: true,
                    maxlength: 150
                },
                description: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "The title field is required.",
                    maxlength: "The maximum length for title is 150."
                },
                identifier: {
                    required: "The identifier field is required.",
                    maxlength: "The maximum length for identifier is 150."
                },
                description: {
                    required: "The description field is required."
                }
            },
            submitHandler: function (form, event) {
                $.blockUI({message: "<h4>Processing...</h4>"});
                form.submit();
            }
        });

        $("body").on("click", "#assignusersform button", function (e) {
            e.preventDefault();
            var btntype = 0;

            if ($(this).attr("value") == "assign") {
                $("#formtype").val(1);
                btntype = 1;
            }
            if ($(this).attr("value") == "unassign") {
                $("#formtype").val(0);
                btntype = 0;
            }

            if (btntype == 1)
            {

                if ($('input:checkbox').filter(':checked').length < 1) {
                    swal({
                        title: "Select at least one user",
                        text: "",
                        type: "warning",
                        timer: 2000
                    });
                    return false;
                } else
                {
                    $.blockUI({message: "<h4>Processing...</h4>"});
                    $("#assignusersModal, .modal-backdrop").css("display", "none");
                    $("#assignusersform")[0].submit();
                }
            } else if (btntype == 0)
            {
                $.blockUI({message: "<h4>Processing...</h4>"});
                $("#assignusersModal, .modal-backdrop").css("display", "none");
                $("#assignusersform")[0].submit();
            }

        });

        $("#assignusersModal").on("hidden.bs.modal", function () {
            $.blockUI({message: "<h4>Resetting...</h4>"});
            window.location.reload(true);
        });

        /*Select All Checkboxes Starts*/

        if ($('.checkbox:checked').length === $('.checkbox').length) {
            $("#selectall").prop('checked', true);
        }

        $("#selectall").change(function () {
            $(".checkbox").prop('checked', $(this).prop("checked"));
        });

        $('.checkbox').change(function () {
            if (false === $(this).prop("checked")) {
                $("#selectall").prop('checked', false);
            }
            if ($('.checkbox:checked').length === $('.checkbox').length) {
                $("#selectall").prop('checked', true);
            }
        });

        /*Select All Checkboxes Ends*/

    });
</script>
@endsection