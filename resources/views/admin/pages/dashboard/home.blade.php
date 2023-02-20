@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('content')
@php $locations = App\Models\Admin\Dashboard::getLocations(); @endphp
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
    </ol>
</div>
<div class="card shadow overflow-hidden">
    <div class="">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                <div class="text-center">
                    <p class="text-light">
                        <i class="fa fa-bar-chart mr-2"></i>
                        Total Students
                    </p>
                    <h2 class="text-primary text-xxl"><?php echo $dashData->totalStudents; ?></h2>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                <div class="text-center">
                    <p class="text-light">
                        <i class="fa fa-users mr-2"></i>
                        Total Coaches
                    </p>
                    <h2 class="text-yellow text-xxl"><?php echo $dashData->totalCoaches; ?></h2>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                <div class="text-center">
                    <p class="text-light">
                        <i class="fa fa-cart-arrow-down mr-2"></i>
                        Total Courses
                    </p>
                    <h2 class="text-warning text-xxl"><?php echo $dashData->totalCourses; ?></h2>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 stats">
                <div class="text-center">
                    <p class="text-light">
                        <i class="fa fa-signal mr-2"></i>
                        Active Courses
                    </p>
                    <h2 class="text-danger text-xxl"><?php echo $dashData->activeCourses; ?> </h2>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">New Coaches</h2>
            </div>
            <div class="card-body table-card-body"> <?php // echo '<pre>'; print_r($coaches); echo '</pre>'; ?>
                <div class="table-responsive">
                    <table id="trialowners" class="tso-pag-table table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p">Coach Name</th>
                                <th class="wd-15p">Email</th>
                                <th class="wd-20p">Phone</th>
                                <th class="wd-20p">Location</th>
                                <th class="wd-25p">Status</th>
                                <th class="wd-20p text-center action-btn">view</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            
            <?php
            if ($coaches) {
                $slno = 1;
                foreach ($coaches as $row) {
                    $na = "N/A";
                    if($row->active == 1){ $active = "Active"; $checked = 'checked="checked"'; }else if ($row->active == 0){ $active = "Inactive"; $checked = ""; }
                    ?>
                    <tr class="dtrow" id="dtrow-<?php echo $row->user_id; ?>">
                    
                        <td>{{$row->name}}</td>
                        <td>{{$row->email}}</td>
                        <td>{{$row->phone}}</td>
                        <td>{{$row->location}}</td>
                        <td>
                            <!--<label class="custom-switch">-->
                            <!--    <input id="status-{{$row->user_id}}" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>-->
                            <!--    <span class="custom-switch-indicator"></span>-->
                            <!--    <span class="custom-switch-description" id="csd-{{$row->user_id}}">{{$active}}</span>-->
                            <!--</label>-->
                            <span class="custom-switch-description" id="csd-{{$row->user_id}}">{{$active}}</span>
                        </td>
                        <td class="text-center">
                              <a href="{{url('/admin/user/coach/'.$row->user_id)}}"><button id="studentEditBtn-{{$row->user_id}} " class="btn btn-sm btn-primary btn-info studentEditBtn"><i class="fa fa-eye"></i>View</button></a>
                            
                        </td>
                    </tr>
                    <?php
                    $slno++;
                }
            }
            ?>
        </tbody>
        
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

{{ csrf_field() }}
<input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $(".tso-pag-table").DataTable({
            paging: false,
            ordering: true,
            responsive: true,
            searching: false,
            info: false,
            language: {
                decimal: "",
                emptyTable: "No trial salon owners found",
                info: "Showing _START_ to _END_ of _TOTAL_ trial salon owners",
                infoEmpty: "Showing 0 to 0 of 0 trial salon owners",
                infoFiltered: "(filtered from _MAX_ total trial salon owners)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Show _MENU_ trial salon owners",
                loadingRecords: "Loading...",
                processing: "Processing...",
                search: "Search:",
                zeroRecords: "No matching trial salon owners found"
            }
        }).column(5).visible(false);


        $("body").on("click", ".tsoeditbtn", function () {
            var uid = this.id;
            var usrid = uid.split('-');
            var userid = usrid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/owner/edit/' + userid;
        });

        $("body").on("click", ".tsoviewbtn", function () {
            var uid = this.id;
            var usrid = uid.split('-');
            var userid = usrid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/owner/view/' + userid;
        });

        $("body").on("click", ".asoeditbtn", function () {
            var uid = this.id;
            var usrid = uid.split('-');
            var userid = usrid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/owner/edit/' + userid;
        });

        $("body").on("click", ".asoviewbtn", function () {
            var uid = this.id;
            var usrid = uid.split('-');
            var userid = usrid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/owner/view/' + userid;
        });

        $("body").on("click", ".tceditbtn", function () {
            var uid = this.id;
            var usrid = uid.split('-');
            var userid = usrid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/customer/edit/' + userid;
        });

        $("body").on("click", ".tcviewbtn", function () {
            var uid = this.id;
            var usrid = uid.split('-');
            var userid = usrid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/users/customer/view/' + userid;
        });
    });
</script>
@endsection