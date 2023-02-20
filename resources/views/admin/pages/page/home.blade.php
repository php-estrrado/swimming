@extends('admin.layouts.app')
@section('title', 'Page Home')
@section('content')
<?php
$banner = "";
$widgetid = $bannerid = "new";
if ($banner != "") {
    $bannerimage = getSiteUrl() . "storage/uploads/admin/pages/home/banner/" . $banner;
    $display = "";
    $remstatus = 1;
} else {
    $bannerimage = "";
    $display = "display:none";
    $remstatus = 0;
}

$breadonly = 'readonly="readonly"';
$wreadonly = 'readonly="readonly"';
?>
<script type="text/javascript" src="{{asset('public/bizzadmin/assets/js/tinymce.min.js')}}"></script>
@if ($errors->any())
<div class="rfalert alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    Please fill all required fields
</div>
@endif
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active" aria-current="page">Home</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Home</h2>
                </div>
                <div class="card-body">
                    <h3 class="mb-2 float-left subhead">Banners</h3>
                    <br>
                    <br>
                    <button id="delete-all-btn" type="button" class="btn btn-sm btn-danger mt-1 mb-1 float-right"><i class="fa fa-trash"></i> Delete Selected</button>
                    <button id="addnewbtn-<?php echo $bannerid; ?>" class="btn-padd btn btn-sm btn-primary float-right"><i class="fa fa-plus"></i> Add Banner</button>
                    <div>
                        <table id="banners" class="tso-pag-table table table-striped table-bordered w-100 text-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p notexport">Select</th>
                                    <th class="wd-15p">Sl No</th>
                                    <th class="wd-15p">Title</th>
                                    <th class="wd-15p">Identifier</th>
                                    <th class="wd-10p">Status</th>
                                    <th class="wd-20p text-center notexport action-btn">Action</th>
                                </tr>
                            </thead>
                            <tbody id="btablecontents">
                                <?php
                                if ($banners) {
                                    $bslno = 1;
                                    foreach ($banners as $banr) {

                                        $na = "N/A";
                                        $banrtitle = ($banr->title) ? $banr->title : $na;
                                        $banridentifier = ($banr->identifier) ? $banr->identifier : $na;
                                        $banrbanner = ($banr->banner) ? $banr->banner : $na;
                                        $banrdescription = ($banr->description) ? $banr->description : $na;
                                        $banrid = ($banr->id) ? $banr->id : $na;

                                        if ($banr->active == 1) {
                                            $banractive = "Active";
                                            $banrchecked = 'checked="checked"';
                                        } else if ($banr->active == 0) {
                                            $banractive = "Inactive";
                                            $banrchecked = "";
                                        }
                                        ?>
                                        <tr class="borderrow bdtrow" data-id="<?php echo $banr->id; ?>" id="bdtrow-<?php echo $banr->id; ?>">
                                            <td></td>
                                            <td><?php echo $bslno; ?></td>
                                            <td><?php echo ucwords($banrtitle); ?></td>
                                            <td><?php echo $banridentifier; ?></td>
                                            <td>
                                                <label class="custom-switch">
                                                    <input id="bstatus-<?php echo $banr->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input bstatus-btn" <?php echo $banrchecked; ?>>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description" id="bcsd-<?php echo $banr->id; ?>">
                                                        <?php echo $banractive; ?>
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <button id="bannereditbtn-<?php echo $banrid; ?>" class="btn btn-sm btn-primary btn-edit bannereditbtn"><i class="fa fa-edit"></i> Edit</button>
                                                <button id="bannerdeletebtn-<?php echo $banrid; ?>" class="btn btn-sm btn-danger btn-delete bannerdeletebtn"><i class="fa fa-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                        <?php
                                        $bslno++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <br>
                    <h3 class="mb-2 subhead">Widgets</h3>
                    <div>
                        <table id="widgets" class="tso-pag-table table table-striped table-bordered w-100 text-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Sl No</th>
                                    <th class="wd-15p">Name</th>
                                    <th class="wd-15p">Identifier</th>
                                    <th class="wd-10p">Status</th>
                                    <th class="wd-20p text-center notexport action-btn">Action</th>
                                </tr>
                            </thead>
                            <tbody id="wtablecontents">
                                <?php
                                if ($widgets) {
                                    $wslno = 1;
                                    foreach ($widgets as $wdgt) {

                                        $na = "N/A";
                                        $wdgttitle = ($wdgt->title) ? $wdgt->title : $na;
                                        $wdgtidentifier = ($wdgt->identifier) ? $wdgt->identifier : $na;
                                        $wdgtdescription = ($wdgt->content) ? $wdgt->content : $na;
                                        $wdgtid = ($wdgt->id) ? $wdgt->id : $na;

                                        if ($wdgt->active == 1) {
                                            $wdgtactive = "Active";
                                            $wdgtchecked = 'checked="checked"';
                                        } else if ($wdgt->active == 0) {
                                            $wdgtactive = "Inactive";
                                            $wdgtchecked = "";
                                        }
                                        ?>
                                        <tr class="worderrow wdtrow" data-id="<?php echo $wdgt->id; ?>" id="wdtrow-<?php echo $wdgt->id; ?>">
                                            <td class="cursor"><?php echo $wslno; ?></td>
                                            <td><?php echo ucwords($wdgttitle); ?></td>
                                            <td><?php echo $wdgtidentifier; ?></td>
                                            <td>
                                                <label class="custom-switch">
                                                    <input id="wstatus-<?php echo $wdgt->id; ?>" type="checkbox" name="option" value="1" class="custom-switch-input wstatus-btn" <?php echo $wdgtchecked; ?>>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="custom-switch-description" id="wcsd-<?php echo $wdgt->id; ?>">
                                                        <?php echo $wdgtactive; ?>
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <button id="widgeteditbtn-<?php echo $wdgtid; ?>" class="btn btn-sm btn-primary btn-edit widgeteditbtn"><i class="fa fa-edit"></i> Edit</button>
                                            </td>
                                        </tr>
                                        <?php
                                        $wslno++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
    </div>
</div>

<!-- Banner Modal Starts-->
<div class="modal fade" id="bannerModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Banner</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php
                $caption = "";
                $btitle = "";
                $bidentifier = "";
                $bactive = 1;
                ?>
                {{ Form::open(array('url' => "admin/pages/banner/save", 'id' => 'bannerform', 'name' => 'bannerform', 'class' => '', 'files' => true)) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('btitle', 'Title', ['class' => 'control-label']) }}
                            <?php echo Form::text('btitle', $btitle, ['class' => 'form-control']) ?>
                            @if ($errors->has('btitle'))
                            <span class="error">{{ $errors->first('btitle') }}</span>
                            @endif
                            <span id="btitle_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('bidentifier', 'Identifier', ['class' => 'control-label']) }}
                            <input type="text" class="form-control" name="bidentifier" id="bidentifier" value="{{$bidentifier}}" <?php echo $breadonly; ?>>
                            @if ($errors->has('bidentifier'))
                            <span class="error">{{ $errors->first('bidentifier') }}</span>
                            @endif
                            <span id="bidentifier_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row dragfiles">
                            <div class="col-md-12">
                                <div class="form-group files">
                                    {{ Form::label('banner', 'Banner', ['class' => 'control-label']) }}
                                    <input type="file" class="form-control" name="banner" id="banner" accept='image/*' onchange="return validateUpload()" style="background-image:url('<?php echo $bannerimage; ?>');">
                                </div>
                            </div>
                            @if ($errors->has('banner'))
                            <span class="error">{{ $errors->first('banner') }}</span>
                            @endif
                            <span id="banner_err" class="error"></span>
                            <button style="<?php echo $display; ?>" name="imgdeletebtn" id="imgdeletebtn" class="btn btn-sm btn-danger btn-delete deletebtn"><i class="fa fa-trash"></i> Remove</button>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('caption', 'Caption', ['class' => 'control-label']) }}
                            <?php echo Form::textarea('caption', $caption, ['class' => 'form-control editor', 'rows' => 3]) ?>
                            @if ($errors->has('caption'))
                            <span class="error">{{ $errors->first('caption') }}</span>
                            @endif
                            <span id="caption_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">   
                        <div class="form-group">
                            {{ Form::label('bstatus', 'Status', ['class' => 'control-label']) }}
                            <?php echo Form::select('bstatus', [0 => 'Disable', 1 => 'Enable'], $bactive, ['class' => 'form-control']) ?>
                            @if ($errors->has('bstatus'))
                            <span class="error">{{ $errors->first('bstatus') }}</span>
                            @endif
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-md-12 ">
                        <input type="hidden" name="bannerid" id="bannerid" value="<?php echo $bannerid; ?>">
                        <input type="hidden" name="bpidentifier" id="bpidentifier" value="<?php echo $page->identifier; ?>">
                        <input type="hidden" name="remstatus" id="remstatus" value="<?php echo $remstatus; ?>">
                        <input type="hidden" name="dimension" id="dimension" value="1">
                        {{ Form::button('Save', array('name' => 'savebtn', 'class' => 'btn btn-primary', 'type' => 'submit')) }}
                    </div>
                </div>
                {{ Form::close() }}

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>
<!-- Banner Modal Ends-->

<!-- Widget Modal Starts-->
<div class="modal fade" id="widgetModal">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h2 class="modal-title">Widget</h2>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <?php
                $description = "";
                $wname = "";
                $widentifier = "";
                $wactive = 1;
                ?>
                {{ Form::open(array('url' => "admin/pages/widget/save", 'id' => 'widgetform', 'name' => 'widgetform', 'class' => '', 'files' => true)) }}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('wname', 'Name', ['class' => 'control-label']) }}
                            <?php echo Form::text('wname', $wname, ['class' => 'form-control']) ?>
                            @if ($errors->has('wname'))
                            <span class="error">{{ $errors->first('wname') }}</span>
                            @endif
                            <span id="wname_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('widentifier', 'Identifier', ['class' => 'control-label']) }}
                            <input type="text" class="form-control" name="widentifier" id="widentifier" value="{{$widentifier}}" <?php echo $wreadonly; ?>>
                            @if ($errors->has('widentifier'))
                            <span class="error">{{ $errors->first('widentifier') }}</span>
                            @endif
                            <span id="widentifier_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('description', 'Description', ['class' => 'control-label']) }}
                            <?php echo Form::textarea('description', $description, ['class' => 'form-control editor', 'rows' => 3]) ?>
                            @if ($errors->has('description'))
                            <span class="error">{{ $errors->first('description') }}</span>
                            @endif
                            <span id="description_err" class="error"></span>
                        </div>
                    </div>
                    <div class="col-md-12">   
                        <div class="form-group">
                            {{ Form::label('wstatus', 'Status', ['class' => 'control-label']) }}
                            <?php echo Form::select('wstatus', [0 => 'Disable', 1 => 'Enable'], $wactive, ['class' => 'form-control']) ?>
                            @if ($errors->has('wstatus'))
                            <span class="error">{{ $errors->first('wstatus') }}</span>
                            @endif
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="col-md-12 ">
                        <input type="hidden" name="uploadpath" id="uploadpath" value="<?php echo 'storage/uploads/admin/pages/home'; ?>">
                        <input type="hidden" name="widgetid" id="widgetid" value="<?php echo $widgetid; ?>">
                        <input type="hidden" name="wpidentifier" id="wpidentifier" value="<?php echo $page->identifier; ?>">
                        {{ Form::button('Save', array('name' => 'savebtn', 'class' => 'btn btn-primary', 'type' => 'submit')) }}
                    </div>
                </div>
                {{ Form::close() }}

            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
            </div>

        </div>
    </div>
</div>
<!-- Widget Modal Ends-->
<style>
    body {
        overflow-x: hidden;
    }
    #addnewbtn-new {
        margin-right: 5px;
        margin-bottom: 10px;
        height: 25px;
        margin-top: -4px !important;
    }
    #delete-all-btn {
        margin-top: -4px !important;
        margin-right: 0px;
        margin-bottom: 10px;
        height: 25px;
    }
    .close {
        margin-top: -5px !important;
        margin-right: 0px  !important;
    }
    .modal-btn {
        float: right;
    }
    .subhead {
        color: #b10012 !important;
    }
    .dt-bootstrap4 .btn-group {
        margin-right: 10px;
    }
    #widgets_filter {
        float: right !important; 
    }
</style>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        tinymce.remove();
        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/settings/editor/image/upload";
        var uploadpath = $("#uploadpath").val();

        $("#bannerModal").on("show.bs.modal", function (e) {
            tinymce.remove();
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
            $(document).on("focusin", function (e) {
                if ($(e.target).closest(".mce-window").length) {
                    e.stopImmediatePropagation();
                }
            });
        });

        $("#widgetModal").on("show.bs.modal", function (e) {
            tinymce.remove();
            tinymce.init({
                selector: '.editor',
                height: 150,
                plugins: [
                    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                    'searchreplace wordcount visualblocks visualchars code fullscreen',
                    'insertdatetime media nonbreaking save table contextmenu directionality iconfonts',
                    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
                ],
                toolbar1: 'undo redo | insert image | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link |print preview media | forecolor backcolor emoticons | codesample',
                tinycomments_mode: 'embedded',
                tinycomments_author: '',
                iconfonts_selector: '.fa, .fab, .fal, .far, .fas, .glyphicon',
                forced_root_block: false,
                image_advtab: true,
                relative_urls: false,
                media_poster: false,
                remove_script_host: false,
                document_base_url: baseurl,
                image_title: true,
                automatic_uploads: true,
                images_upload_base_path: baseurl,
                images_upload_url: posturl,
                file_picker_types: 'image',
                images_upload_handler: function (blobInfo, success, failure) {
                    var xhr, formData;
                    xhr = new XMLHttpRequest();
                    xhr.withCredentials = false;
                    xhr.open('POST', posturl);
                    var token = $('meta[name="csrf-token"]').attr('content');
                    xhr.setRequestHeader("X-CSRF-Token", token);
                    xhr.onload = function () {
                        var json;
                        if (xhr.status != 200) {
                            failure('HTTP Error: ' + xhr.status);
                            return;
                        }
                        json = JSON.parse(xhr.responseText);

                        if (!json || typeof json.location != 'string') {
                            failure('Invalid JSON: ' + xhr.responseText);
                            return;
                        }
                        success(json.location);
                    };
                    formData = new FormData();
                    formData.append('file', blobInfo.blob(), blobInfo.filename());
                    formData.append('uploadpath', uploadpath);
                    xhr.send(formData);
                },
                file_picker_callback: function (cb, value, meta) {
                    var input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');
                    input.onchange = function () {
                        var file = this.files[0];

                        var reader = new FileReader();
                        reader.onload = function () {
                            var id = 'blobid' + (new Date()).getTime();
                            var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                            var base64 = reader.result.split(',')[1];
                            var blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);
                            cb(blobInfo.blobUri(), {title: file.name});
                        };
                        reader.readAsDataURL(file);
                    };

                    input.click();
                }
            });
            $(document).on("focusin", function (e) {
                if ($(e.target).closest(".mce-window").length) {
                    e.stopImmediatePropagation();
                }
            });
        });

        $("#bannerModal, #widgetModal").on("hidden.bs.modal", function () {
            $("#widgetid").val("new");
            $("#bannerid").val("new");
            tinymce.activeEditor.setContent("");
            tinymce.remove();
            $(".error").text("");
            $("#banner").val("");
            $("#banner").css("background-image", "url('')");
            $("#imgdeletebtn").css("display", "none");
            $("#remstatus").val(3);
        });

        var widgetvalidator = $("#widgetform").validate({
            ignore: ":hidden:not(#description)",
            rules: {
                wname: "required",
                widentifier: "required"
            },
            messages: {
                wname: "The name field is required.",
                widentifier: "The identifier field is required."
            },
            submitHandler: function (form, event) {

                var editorContent = tinymce.get("description").getContent();
                if (editorContent == "")
                {
                    $("#description_err").text("The description field is required.");
                } else
                {
                    $.blockUI({message: "<h4>Processing...</h4>"});
                    $(".modal").modal("hide");
                    form.submit();
                }

            }
        });

        var bannervalidator = $("#bannerform").validate({
            ignore: ":hidden:not(#caption)",
            rules: {
                btitle: "required",
                bidentifier: "required"
            },
            messages: {
                btitle: "The title field is required.",
                bidentifier: "The identifier field is required."
            },
            submitHandler: function (form, event) {
                event.preventDefault();
                var submitButtonName = $(this.submitButton).attr("name");
                var filevalue = $("#banner").val();
                if (submitButtonName == "savebtn")
                {

                    var dimension = $("#dimension").val();

                    if (filevalue != "")
                    {
                        if (validateUpload() && dimension == 1)
                        {
                            $.blockUI({message: "<h4>Processing...</h4>"});
                            $(".modal").modal("hide");
                            form.submit();
                        }
                    } else {
                        $("#banner_err").text("The banner field is required.");
                    }
                }
            }
        });

        var filevalue = $("#banner").val();
        if (filevalue == "")
        {
            $("#remstatus").val(0);
        } else {
            $("#remstatus").val(1);
        }
        $("#dimension").val(1);

        $("body").on("click", "#imgdeletebtn", function () {
            $("#banner").val("");
            $("#banner").css("background-image", "url('')");
            $("#imgdeletebtn").css("display", "none");
            $("#remstatus").val(3);
        });

        $("body").on("click", "#addnewbtn-new", function () {
            var bannerid = this.id;
            var banrid = bannerid.split('-');
            var bid = banrid[1];
            var baseurl = $("#baseurl").val();

            $("#bannerModal").modal("show");

            $("#btitle").val("");
            $("#bidentifier").attr("readonly", false);
            $("#bidentifier").val("");
            tinymce.get("caption").setContent("");
            $("#caption").val("");
            $("#bstatus").val(1);

            $("#banner").val("");
            $("#banner").css("background-image", "url('')");
            $("#imgdeletebtn").css("display", "none");
            $("#remstatus").val(0);

            $(".modal input").css("color", "#8898aa");
            $(".modal input").css("font-weight", "normal");
            $(".modal input").css("font-size", "14px");

        });

        $("body").on("click", ".widgeteditbtn", function () {
            var widgetid = this.id;
            var wdgtid = widgetid.split('-');
            var wid = wdgtid[1];
            var baseurl = $("#baseurl").val();
            var posturl = baseurl + "/admin/pages/widget/getwidget";
            var method = "POST";

            $("#widgetModal").modal("show");
            tinymce.get("description").setContent("");

            $.ajax({
                type: method,
                url: posturl,
                beforeSend: function () {

                },
                data: {wid: wid},
                success: function (data) {

                    $("#widgetid").val(wid);
                    $("#wname").val(data.widget.title);
                    $("#widentifier").val(data.widget.identifier);
                    if (data.widget.content !== null)
                    {
                        tinymce.get("description").setContent(data.widget.content);
                    }
                    $("#wstatus").val(data.widget.status);

                    $(".modal input").css("color", "#8898aa");
                    $(".modal input").css("font-weight", "normal");
                    $(".modal input").css("font-size", "14px");

                }
            });

        });


        $("body").on("click", ".bannereditbtn", function () {

            var bannerid = this.id;
            var banrid = bannerid.split('-');
            var bid = banrid[1];
            var baseurl = $("#baseurl").val();
            var posturl = baseurl + "/admin/pages/banner/getbanner";
            var method = "POST";

            $("#bannerModal").modal("show");
            tinymce.get("caption").setContent("");

            $.ajax({
                type: method,
                url: posturl,
                beforeSend: function () {

                },
                data: {bid: bid},
                success: function (data) {

                    $("#bannerid").val(bid);
                    $("#btitle").val(data.banner.title);
                    $("#bidentifier").val(data.banner.identifier);
                    if (data.banner.description !== null)
                    {
                        tinymce.get("caption").setContent(data.banner.description);
                    }
                    $("#bstatus").val(data.banner.active);

                    var bannerimage = baseurl + "/storage/uploads/admin/pages/home/banner/" + data.banner.banner;
                    $("#banner").val("");
                    $("#banner").css("background-image", "url(" + bannerimage + ")");
                    if (data.banner.banner != "")
                    {
                        $("#imgdeletebtn").css("display", "block");
                    } else
                    {
                        $("#imgdeletebtn").css("display", "none");
                    }
                    $("#remstatus").val(1);

                    $(".modal input").css("color", "#8898aa");
                    $(".modal input").css("font-weight", "normal");
                    $(".modal input").css("font-size", "14px");

                }
            });

        });

        $("body").on("change", ".bstatus-btn", function () {

            var bannerid = this.id;
            var banrid = bannerid.split('-');
            var bid = banrid[1];
            var sts = $(this).prop("checked");
            var tablename = "banner";
            var baseurl = $("#baseurl").val();
            var posturl = baseurl + '/admin/pages/banner/changestatus';
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

                    if (bid != '')
                    {

                        $.blockUI({message: "<h4>Processing...</h4>"});

                        $.ajax({
                            type: method,
                            url: posturl,
                            data: {bid: bid, status: status, tablename: tablename},
                            success: function (data) {
                                $.unblockUI();
                                if (data.type == 'warning' || data.type == 'error')
                                {
                                    if (status == 1)
                                    {
                                        $("#" + bannerid).prop("checked", false);
                                    } else if (status == 0)
                                    {
                                        $("#" + bannerid).prop("checked", true);
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
                                        var msg = "Banner Activated Successfully";
                                        $("#bcsd-" + bid).text("Active");
                                    } else if (status == 0)
                                    {
                                        var msg = "Banner Deactivated Successfully";
                                        $("#bcsd-" + bid).text("Inactive");
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
                            $("#" + bannerid).prop("checked", false);
                        } else if (status == 0)
                        {
                            $("#" + bannerid).prop("checked", true);
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
                        $("#" + bannerid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + bannerid).prop("checked", true);
                    }
                }
            });
        });

        $("body").on("change", ".wstatus-btn", function () {

            var widgetid = this.id;
            var wdgtid = widgetid.split('-');
            var wid = wdgtid[1];
            var sts = $(this).prop("checked");
            var tablename = "widgets";
            var baseurl = $("#baseurl").val();
            var posturl = baseurl + '/admin/pages/widget/changestatus';
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

                    if (wid != '')
                    {

                        $.blockUI({message: "<h4>Processing...</h4>"});

                        $.ajax({
                            type: method,
                            url: posturl,
                            data: {wid: wid, status: status, tablename: tablename},
                            success: function (data) {
                                $.unblockUI();
                                if (data.type == 'warning' || data.type == 'error')
                                {
                                    if (status == 1)
                                    {
                                        $("#" + widgetid).prop("checked", false);
                                    } else if (status == 0)
                                    {
                                        $("#" + widgetid).prop("checked", true);
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
                                        var msg = "Widget Activated Successfully";
                                        $("#wcsd-" + wid).text("Active");
                                    } else if (status == 0)
                                    {
                                        var msg = "Widget Deactivated Successfully";
                                        $("#wcsd-" + wid).text("Inactive");
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
                            $("#" + widgetid).prop("checked", false);
                        } else if (status == 0)
                        {
                            $("#" + widgetid).prop("checked", true);
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
                        $("#" + widgetid).prop("checked", false);
                    } else if (status == 0)
                    {
                        $("#" + widgetid).prop("checked", true);
                    }
                }
            });
        });

        $("body").on("click", ".bannerdeletebtn", function () {
            var bannerid = this.id;
            var banrid = bannerid.split('-');
            var bid = banrid[1];
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
                    if (bid != '')
                    {
                        window.location.href = baseurl + '/admin/banner/pages/delete/' + bid;
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

        var btable = $("#banners").DataTable({
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
                emptyTable: "No banner found",
                info: "Showing _START_ to _END_ of _TOTAL_ banner",
                infoEmpty: "Showing 0 to 0 of 0 banner",
                infoFiltered: "(filtered from _MAX_ total banner)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Show _MENU_ banner",
                loadingRecords: "Loading...",
                processing: "Processing...",
                search: "Search:",
                zeroRecords: "No matching banner found",
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
            var tablename = "banner";
            var method = "POST";
            var posturl = baseurl + '/admin/pages/banner/deleteall';

            var bid, baid, banrid, cls;
            var bannerids = [];

            btable.rows().every(function (index) {
                bid = this.id();
                baid = bid.split('-');
                banrid = baid[1];
                cls = btable.row("#" + bid).node().className;

                if (cls.toLowerCase().indexOf("selected") >= 0)
                {
                    bannerids.push(banrid);
                }

            });

            if (bannerids.length > 0)
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
                            data: {tablename: tablename, bannerids: bannerids},
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
                    title: "Select atleast one banner",
                    text: "",
                    type: "warning",
                    timer: 2000
                });
            }

        });

        var wtable = $("#widgets").DataTable({
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
            order: [[0, "asc"]],
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
            columnDefs: [
                {width: "5%", targets: 0},
                {width: "35%", targets: 1},
                {width: "35%", targets: 2},
                {width: "15%", targets: 3},
                {width: "10%", targets: 4}
            ],
            language: {
                decimal: "",
                emptyTable: "No widget found",
                info: "Showing _START_ to _END_ of _TOTAL_ widget",
                infoEmpty: "Showing 0 to 0 of 0 widget",
                infoFiltered: "(filtered from _MAX_ total widget)",
                infoPostFix: "",
                thousands: ",",
                lengthMenu: "Show _MENU_ widget",
                loadingRecords: "Loading...",
                processing: "Processing...",
                search: "Search:",
                zeroRecords: "No matching widget found",
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

        $("#btablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.5,
            update: function () {
                sendOrderTobServer();
            }
        });

        $("#wtablecontents").sortable({
            items: "tr",
            cursor: 'move',
            opacity: 0.5,
            update: function () {
                sendOrderTowServer();
            }
        });

        function sendOrderTobServer() {

            var searchvalue = $('#banners_filter input[type="search"]').val();

            if (searchvalue === "")
            {

                var method = "POST";
                var dtype = "json";
                var baseurl = $("#baseurl").val();
                var posturl = baseurl + '/admin/pages/banner/order/update';

                var info = btable.page.info();
                var page = info.page;
                var length = info.length;
                var end = page * length;

                var order = [];
                $('tr.borderrow').each(function (index, element) {

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

        function sendOrderTowServer() {

            var searchvalue = $('#widgets_filter input[type="search"]').val();

            if (searchvalue === "")
            {

                var method = "POST";
                var dtype = "json";
                var baseurl = $("#baseurl").val();
                var posturl = baseurl + '/admin/pages/widget/order/update';

                var info = wtable.page.info();
                var page = info.page;
                var length = info.length;
                var end = page * length;

                var order = [];
                $('tr.worderrow').each(function (index, element) {

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

    function validateUpload() {
        $("#banner_err").text("");
        var fileUpload = document.getElementById("banner");
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpeg|.jpg|.png|.gif)$");
        if (fileUpload.files[0].size > 4194304) {
            $("#banner_err").text("The banner may not be greater than 4MB");
            return false;
        } else if (regex.test(fileUpload.value.toLowerCase())) {
            if (typeof (fileUpload.files) != "undefined") {
                var reader = new FileReader();
                reader.readAsDataURL(fileUpload.files[0]);
                reader.onload = function (e) {
                    var image = new Image();
                    image.src = e.target.result;
                    image.onload = function () {
                        var height = this.height;
                        var width = this.width;

                        var ratio = parseInt(width) / parseInt(height);

                        if (height > 768 || width > 3072 || height < 256 || width < 1024 || ratio < 2 || ratio > 3) {
                            $("#banner_err").text("The banner has invalid image dimensions.(min width: 1024px, min height: 256px, max width: 3072px, max height: 768px, ratio: between 1:2 and 1:3)");
                            $("#dimension").val(0);
                            return false;
                        } else {
                            $("#dimension").val(1);
                            return true;
                        }
                    };
                    $("#banner").css("background-image", "url(" + e.target.result + ")");
                    $("#imgdeletebtn").css("display", "block");
                    $("#remstatus").val(2);
                }
            } else {
                $("#banner_err").text("This browser does not support HTML5");
                return false;
            }
        } else {
            $("#banner_err").text("The banner must be a file of type: jpeg, png, jpg, gif.");
            return false;
        }
        return true;
    }

</script>
@endsection