@extends('admin.layouts.app')
@section('title', 'Contact Details')
@section('content')
<!-- Page content -->
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/contacts')}}">Contacts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Contact Details</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Contact Details</h2>
                </div>
                <div class="card-body">

                    <?php
                    if ($contact) {

                        $na = "N/A";
                        $name = ($contact->name) ? $contact->name : $na;
                        $email = ($contact->email) ? $contact->email : $na;
                        $subject = ($contact->subject) ? $contact->subject : $na;
                        $message = ($contact->message) ? $contact->message : $na;
                        ?>

                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Name:</td>
                                                    <td style="width:50%;"><?php echo ucfirst($name); ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Email:</td>
                                                    <td style="width:50%;"><?php echo $email; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Subject: </td>
                                                    <td style="width:50%;"><?php echo $subject; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                        <td style="width:50%;padding: 0">
                                            <table style="width:100%">
                                                <tr>
                                                    <td style="width:50%;">Message: </td>
                                                    <td style="width:50%;"><?php echo $message; ?></td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{ csrf_field() }}
                        <input type="hidden" name="uid" id="uid" value="{{$contact->id}}">
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