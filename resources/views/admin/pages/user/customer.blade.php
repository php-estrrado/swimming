@extends('admin.layouts.app')
@section('title', 'Customer Details')
@section('content')
<!-- Page content -->
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/users/customer')}}">Customer</a></li>
            <li class="breadcrumb-item active" aria-current="page">Customer Details</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Customer Details</h2>
                </div>
                <div class="card-body">

                    <?php
                    if ($user) {

                        $na = "N/A";
                        $cust_id = ($user->cust_id) ? $user->cust_id : $na;
                        $cname = ($user->cname) ? $user->cname : $na;
                        $cemail = ($user->cemail) ? $user->cemail : $na;
                        $cphone = ($user->cphone) ? $user->cphone : $na;
                        $gender = ($user->gender) ? $user->gender : $na;
                        $dob = ($user->dob) ? dateFormat($user->dob, 1) : $na;
                        $location = ($user->location) ? $user->location : $na;
                        $company_name = ($user->company_name) ? $user->company_name : $na;
                        $address = ($user->address) ? $user->address : $na;
                        $anniversary = ($user->anniversary) ? dateFormat($user->anniversary, 1) : $na;
                        $regdate = ($user->ccreated_at) ? dateFormat($user->ccreated_at, 1) : $na;

                        if ($user->cactive == 1) {
                            $active = "Active";
                        } else if ($user->cactive == 0) {
                            $active = "Inactive";
                        }
                        ?>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Customer Name:</td>
                                                    <td style="width:50%;"><?php echo ucwords($cname); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Customer Code:</td>
                                                    <td style="width:50%;"><?php echo $cust_id; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Phone: </td>
                                                    <td style="width:50%;"><?php echo $cphone; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Email: </td>
                                                    <td style="width:50%;"><?php echo $cemail; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Date of Birth: </td>
                                                    <td style="width:50%;"><?php echo $dob; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Gender: </td>
                                                    <td style="width:50%;"><?php echo ucfirst($gender); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Location: </td>
                                                    <td style="width:50%;"><?php echo ucwords($location); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Address: </td>
                                                    <td style="width:50%;"><?php echo ucwords($address); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Anniversary: </td>
                                                    <td style="width:50%;"><?php echo $anniversary; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Company Name: </td>
                                                    <td style="width:50%;"><?php echo ucwords($company_name); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Registered On: </td>
                                                    <td style="width:50%;"><?php echo $regdate; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Status: </td>
                                                    <td style="width:50%;"><?php echo $active; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{ csrf_field() }}
                        <input type="hidden" name="uid" id="uid" value="{{$user->cid}}">
                        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
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
    @endsection