@extends('admin.layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="page-header mt-0 shadow p-3">
    <ol class="breadcrumb mb-sm-0">
        <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">FAQ</li>
    </ol>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="card shadow">
            <div class="card-header">
                <h2 class="mb-2">FAQ</h2>
                <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                <button id="addnewbtn" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add FAQ</button>
            </div>
            <div class="card-body table-card-body">
                <div>
                    <table id="faqs" class="table table-striped table-bordered w-100 text-nowrap">
                        <thead>
                            <tr>
                                <th class="wd-15p notexport">Select</th>
                                <th class="wd-15p">Sl No</th>
                                <th class="wd-20p">Question</th>
                                <th class="wd-10p">Answer</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-25p text-center notexport action-btn">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tablecontents"><?php
                            if ($faqs) {
                                $slno = 1;
                                foreach ($faqs as $faq) {

                                    $na = "N/A";
                                    $qst = ($faq->question) ? $faq->question : $na;
                                    $ans = ($faq->answer) ? $faq->answer : $na;

                                    if ($qst != "N/A") {
                                        $title = strip_tags($qst);
                                        $question = subWord($title, 0, 3) . "...";
                                    }

                                    if ($ans != "N/A") {
                                        $content = strip_tags($ans);
                                        $answer = subWord($content, 0, 3) . "...";
                                    }

                                    if ($faq->active == 1) {
                                        $active = "Active";
                                        $checked = 'checked="checked"';
                                    } else if ($faq->active == 0) {
                                        $active = "Inactive";
                                        $checked = "";
                                    }
                                    ?>
                                    <tr class="orderrow dtrow" data-id="<?php echo $faq->id; ?>" id="dtrow-<?php echo $faq->id; ?>">
                                        <td></td>
                                        <td><?php echo $slno; ?></td>
                                        <td><?php echo $question; ?></td>
                                        <td><?php echo $answer; ?></td>
                                        <td>
                                            <label class="custom-switch">
                                                <input id="status-<?php echo $faq->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input status-btn" <?php echo $checked; ?>>
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description" id="csd-<?php echo $faq->id; ?>">
                                                    <?php echo $active; ?>
                                                </span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <button id="editbtn-<?php echo $faq->id; ?>" class="btn btn-sm btn-primary btn-edit editbtn"><i class="fa fa-edit"></i> Edit</button>
                                            <?php if ($faq->id != 0) { ?>
                                                <button id="deletebtn-<?php echo $faq->id; ?>" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Delete</button>
                                            <?php } ?>
                                        </td>
                                    </tr><?php
                                    $slno++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    {{ csrf_field() }}
                    <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                </div>
            </div>

        </div>
    </div>
</div>
<style>
    .btn-padd {
        margin-right: 5px;
        margin-top: 4px;
    }
</style>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        $("body").on("click", "#addnewbtn", function () {
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/settings/faq/new';
        });

        $("body").on("click", ".editbtn", function () {
            var faqid = this.id;
            var faid = faqid.split('-');
            var fid = faid[1];
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin/settings/faq/' + fid;
        });

        $("body").on("click", ".deletebtn", function () {

            var faqid = this.id;
            var faid = faqid.split('-');
            var fid = faid[1];
            var baseurl = $("#baseurl").val();

            swal({
                title: "Are you sure?",
                text: "",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {
                    if (fid != '')
                    {
                        window.location.href = baseurl + '/admin/settings/delete/faq/' + fid;
                    } else
                    {
                        swal({
                            title: "Something went wrong",
                            text: "",
                            type: "error",
                            timer: 2000
                        });
                    }
                }
            });

        });

        $("body").on("change", ".status-btn", function () {
            var faqid = this.id;
            var faid = faqid.split('-');
            var fid = faid[1];
            var sts = $(this).prop("checked");
            var tablename = "faqs";
            var baseurl = $("#baseurl").val();
            var posturl = baseurl + '/admin/settings/faq/changestatus';
            var method = "POST";

            if (sts == true)
            {
                var status = 1;
            } else if (sts == false)
            {
                var status = 0;
            }

            swal({
                title: "Are you sure?",
                text: "",
                type: "info",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: true,
                closeOnCancel: true
            }, function (isConfirm) {
                if (isConfirm) {

                    if (fid != '')
                    {

                        $.blockUI({message: "<h4>Processing...</h4>"});

                        $.ajax({
                            type: method,
                            url: posturl,
                            data: {fid: fid, status: status, tablename: tablename},
                            success: function (data) {
                                $.unblockUI();
                                if (data.type == 'warning' || data.type == 'error')
                                {
                                    if (status == 1)
                                    {
                                        $("#" + faqid).prop("checked", false);
                                    } else if (status == 0)
                                    {
                                        $("#" + faqid).prop("checked", true);
                                    }
                                    swal({
                                        title: data.msg,
                                        text: "",
                                        type: data.type,
                                        timer: 2000
                                    });
                                } else {
                                    if (status == 1)
                                    {
                                        var msg = "Faq Activated Successfully";
                                        $("#csd-" + fid).text("Active");
                                    } else if (status == 0)
                                    {
                                        var msg = "Faq Deactivated Successfully";
                                        $("#csd-" + fid).text("Inactive");
                                    }
                                    swal({
                                        title: msg,
                                        text: "",
                                        type: "success",
                                        timer: 2000
                                    });
                                }
                            }
                        });
                    } else
                    {
                        if (status == 1)
                        {
                            $("#" + faqid).prop("checked", false);
                        } else if (status == 0)
                        {
                            $("#" + faqid).prop("checked", true);
                        }
                        swal({
                            title: "Something went wrong",
                            text: "",
                            type: "error",
                            timer: 2000
                        });
                    }
                } else
                {
                    if (status == 1)
                    {
                        $("#" + faqid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + faqid).prop("checked", true);
                    }
                }
            });
        });

        var table = $("#faqs").DataTable({
            pageLength: 10,
            rowReorder: false,
            colReorder: true,
            paging: true,
            pagingType: "simple_numbers",
            lengthChange: true,
            searching: true,
            ordering: false,
            info: true,
            autoWidth: true,
            fixedHeader: true,
            orderCellsTop: false,
            keys: false,
            responsive: true,
            processing: true,
            scrollX: false,
            scrollCollapse: true,
            serverSide: false,
            stateSave: true,
            search: {
                caseInsensitive: true,
                smart: true
            },
            orderMulti: false,
            dom: "Blfrtip",
            order: [[0, "asc"]],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            buttons: [
                {
                    extend: "selectAll",
                    text: '<i class="fa fa-check"></i>Select All',
                    titleAttr: "Select All"
                },
                {
                    extend: "selectNone",
                    text: '<i class="fa fa-times"></i>Select None',
                    titleAttr: "Deselect All"
                }
            ],
            columnDefs: [
                {
                    orderable: false,
                    className: "select-checkbox",
                    targets: 0
                },
                {width: "5%", targets: 0},
                {width: "5%", targets: 1},
                {width: "30%", targets: 2},
                {width: "30%", targets: 3},
                {width: "15%", targets: 4},
                {width: "15%", targets: 5}
            ],
            select: {
                style: "multi",
                selector: "td:first-child"
            },
            language: {
                decimal: "",
                emptyTable: "No faq found",
                info: "Showing _START_ to _END_ of _TOTAL_ faq",
                infoEmpty: "Showing 0 to 0 of 0 faq",
                infoFiltered: "(filtered from _MAX_ total faq)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Show _MENU_ faq",
                loadingRecords: "Loading...",
                processing: "Processing...",
                search: "Search:",
                zeroRecords: "No matching faq found",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                },
                aria: {
                    sortAscending: ": activate to sort column ascending",
                    sortDescending: ": activate to sort column descending"
                },
                buttons: {
                    copyTitle: 'Copied to clipboard',
                    copySuccess: {
                        _: "%d rows copied",
                        1: "1 row copied"
                    }
                }
            }
        });

        $("body").on("click", "#delete-all-btn", function () {

            var baseurl = $("#baseurl").val();
            var tablename = "faqs";
            var method = "POST";
            var posturl = baseurl + '/admin/settings/faq/deleteall';

            var fid, faid, faqid, cls;
            var faqids = [];

            table.rows().every(function (index) {
                fid = this.id();
                faid = fid.split('-');
                faqid = faid[1];
                cls = table.row("#" + fid).node().className;

                if (cls.toLowerCase().indexOf("selected") >= 0)
                {
                    faqids.push(faqid);
                }

            });

            if (faqids.length > 0)
            {

                swal({
                    title: "Are you sure?",
                    text: "",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                    closeOnConfirm: true,
                    closeOnCancel: true
                }, function (isConfirm) {
                    if (isConfirm) {

                        $.blockUI({message: "<h4>Processing...</h4>"});

                        $.ajax({
                            type: method,
                            url: posturl,
                            data: {tablename: tablename, faqids: faqids},
                            success: function (data) {
                                $.unblockUI();
                                swal({
                                    title: data.msg,
                                    text: "",
                                    type: data.type,
                                    timer: 2000
                                }, function () {
                                    window.location.reload();
                                });
                            },
                            error: function (json)
                            {
                                $.unblockUI();
                                swal({
                                    title: "Something went wrong",
                                    text: "",
                                    type: "error",
                                    timer: 2000
                                });
                            }
                        });

                    }
                });

            } else {
                swal({
                    title: "Select atleast one faq",
                    text: "",
                    type: "warning",
                    timer: 2000
                });
            }

        });

        $("#tablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.5,
            update: function () {
                sendOrderToServer();
            }
        });

        function sendOrderToServer() {

            var searchvalue = $('input[type="search"]').val();

            if (searchvalue === "")
            {

                var method = "POST";
                var dtype = "json";
                var baseurl = $("#baseurl").val();
                var posturl = baseurl + '/admin/settings/faq/order/update';

                var info = table.page.info();
                var page = info.page;
                var length = info.length;
                var end = page * length;

                var order = [];
                $('tr.orderrow').each(function (index, element) {

                    var pageitem = index + 1;
                    var position = parseInt(end) + parseInt(pageitem);

                    order.push({
                        id: $(this).attr('data-id'),
                        position: position
                    });
                });

                $.ajax({
                    type: method,
                    dataType: dtype,
                    url: posturl,
                    data: {order: order, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        if (data != 1)
                        {
                            swal({
                                title: "Something went wrong",
                                text: "",
                                type: "error",
                                timer: 2000
                            });
                        }
                    },
                    error: function (json)
                    {
                        swal({
                            title: "Something went wrong",
                            text: "",
                            type: "error",
                            timer: 2000
                        });
                    }
                });

            } else
            {
                swal({
                    title: "Reorder not working with search result",
                    text: "",
                    type: "warning",
                    timer: 2000
                });
            }

        }
    });
</script>
@endsection