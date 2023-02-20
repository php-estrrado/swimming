@extends('admin.layouts.app')
@section('title', 'Upgrade Membership')
@section('content')
<!-- Page content -->
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/users/owner')}}">Salon Owners</a></li>
            <li id="breadcrumb-sod" class="breadcrumb-item"><a href="javascript:void(0);">Salon Owner Details</a></li>
            <li class="breadcrumb-item active" aria-current="page">Change Membership Plan</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Change Membership Plan</h2>
                </div>
                <div class="card-body">
                    <?php
                    if ($user && $cmembership) {
                        ?>
                        <form id="upgrademembershipform" name="upgrademembershipform" method="POST" action="{{url('admin/users/owner/upgrade/membership')}}">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Membership</label>
                                        <select name="membership" id="membership" class="form-control custom-select">
                                            <?php
                                            if ($memberships) {
                                                foreach ($memberships as $membership) {
                                                    $mselected = "";
                                                    //if ($membership->id != 0) {
                                                    if ($membership->id == $cmembership->membership_id) {
                                                        $mselected = 'selected="selected"';
                                                    }
                                                    ?>
                                                    <option <?php echo $mselected; ?> value="<?php echo $membership->id; ?>"><?php echo $membership->name; ?></option>
                                                    <?php
                                                    //}
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="error" id="membership-err">{{ $errors->first('membership') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Membership Validity</label>
                                        <select name="validity" id="validity" class="form-control custom-select">
                                            <?php
                                            if ($validities) {
                                                foreach ($validities as $validity) {
                                                    $vselected = "";
                                                    //if ($validity->id != 1) {
                                                    if ($validity->id == $cmembership->validity_id) {
                                                        $vselected = 'selected="selected"';
                                                    }
                                                    ?>
                                                    <option <?php echo $vselected; ?> value="<?php echo $validity->id; ?>"><?php echo $validity->validity_type; ?></option>
                                                    <?php
                                                    //}
                                                }
                                            }
                                            ?>
                                        </select>
                                        <div class="error" id="validity-err">{{ $errors->first('validity') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                                {{ csrf_field() }}
                                <div class="col-md-12 ">
                                    <input type="hidden" name="user_type" id="user_type" value="{{$user->user_type}}">
                                    <input type="hidden" name="uid" id="uid" value="{{$user->uid}}">
                                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                                    <button id="cancelbtn" type="button" class="btn btn-default mt-1 mb-1">Cancel</button>
                                    <button type="submit" class="btn btn-primary mt-1 mb-1">Change</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <style>
        .main-content .container-fluidd {
            padding-right: 0px !important;
            padding-left: 0px !important;
        }
        .pt-88 {
            padding-top: 0rem !important;
        }
    </style>
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function () {

            var readyload = 1;

            $("body").on("click", "#cancelbtn, #breadcrumb-sod", function () {
                var baseurl = $("#baseurl").val();
                var userid = $("#uid").val();
                window.location.href = baseurl + '/admin/users/owner/view/' + userid;
            });

            $("body").on("submit", "#upgrademembershipform", function (e) {
                e.preventDefault();
                $.blockUI({message: "<h4>Processing...</h4>"});
                $("#upgrademembershipform")[0].submit();
            });

            $("body").on("change", "#membership", function () {
                if (readyload != 1)
                {
                    var membership = $(this).find(":selected").val();
                    var validity = $("#validity").val();

                    $("#validity").children("option").prop("selected", false);

                    if (membership != 0)
                    {
                        $("#validity").children("option").show();
                        $("#validity").children("option[value=1]").hide();
                        if (validity == 2)
                        {
                            $("#validity").children("option[value=2]").prop("selected", true);
                        } else if (validity == 3)
                        {
                            $("#validity").children("option[value=3]").prop("selected", true);
                        } else {
                            $("#validity").children("option[value=2]").prop("selected", true);
                        }
                    } else if (membership == 0)
                    {
                        $("#validity").children("option").hide();
                        $("#validity").children("option[value=1]").show();
                        $("#validity").children("option[value=1]").prop("selected", true);
                    }
                }
                readyload = 0;
            });

            resetMembershipForm();

        });

        function resetMembershipForm() {

            var membership = $("#membership").val();

            if (membership != 0)
            {
                $("#validity").children("option[value=1]").hide();
            } else if (membership == 0)
            {
                $("#validity").children("option[value!=1]").hide();
            }
        }

    </script>
    @endsection