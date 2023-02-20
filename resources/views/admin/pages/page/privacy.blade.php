@extends('admin.layouts.app')
@section('title', 'Page Privacy')
@section('content')
<?php
$na = "";
$pid = ($page) ? $page->id : 0;
$title = ($page) ? $page->title : $na;
$banner = ($page) ? $page->image : $na;
$identifier = ($page) ? $page->identifier : $na;
$description = ($page) ? $page->content : $na;
$active = ($page) ? $page->active : 1;

if ($banner != "") {
    $bannerimage = getSiteUrl() . "storage/uploads/admin/pages/" . $banner;
    $display = "";
    $remstatus = 1;
} else {
    $bannerimage = "";
    $display = "display:none";
    $remstatus = 0;
}

$readonly = 'readonly="readonly"';
?>
<script type="text/javascript" src="{{asset('public/bizzadmin/assets/js/tinymce.min.js')}}"></script>
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item">Pages</li>
            <li class="breadcrumb-item active" aria-current="page">Privacy</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0">Privacy</h2>
                </div>
                <div class="card-body">
                    {{ Form::open(array('url' => "admin/pages/save", 'id' => 'pageform', 'name' => 'pageform', 'class' => '', 'files' => true)) }}
                    <input type="hidden" name="id" id="id" value="<?php echo $pid ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
                                <?php echo Form::text('title', $title, ['class' => 'form-control']) ?>
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
                                <?php echo Form::textarea('description', $description, ['class' => 'form-control editor', 'rows' => 3]) ?>
                                @if ($errors->has('description'))
                                <span class="error">{{ $errors->first('description') }}</span>
                                @endif
                                <span id="description_err" class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">   
                                    <div class="form-group">
                                        {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                                        <?php echo Form::select('status', [0 => 'Disable', 1 => 'Enable'], $active, ['class' => 'form-control']) ?>
                                        @if ($errors->has('status'))
                                        <span class="error">{{ $errors->first('status') }}</span>
                                        @endif
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
                            </div>
                        </div>

                        {{ csrf_field() }}
                        <div class="col-md-12 ">
                            <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
                            <input type="hidden" name="uploadpath" id="uploadpath" value="<?php echo 'storage/uploads/admin/pages/'; ?>">
                            <input type="hidden" name="remstatus" id="remstatus" value="<?php echo $remstatus; ?>">
                            <input type="hidden" name="dimension" id="dimension" value="1">
                            <button name="cancelbtn" id="cancelbtn" type="button" class="btn btn-default mt-1 mb-1">Cancel</button>
                            {{ Form::button('Save', array('name' => 'savebtn', 'class' => 'btn btn-primary', 'type' => 'submit')) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {

        var baseurl = $("#baseurl").val();
        var posturl = baseurl + "/admin/settings/editor/image/upload";
        var uploadpath = $("#uploadpath").val();

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

        $("body").on("click", "#cancelbtn", function () {
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/admin';
        });

        var validator = $("#pageform").validate({
            ignore: ":hidden:not(#description)",
            rules: {
                title: "required",
                identifier: "required",
                description: "required"
            },
            messages: {
                title: "The title field is required.",
                identifier: "The identifier field is required.",
                description: "The description field is required."
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
                            form.submit();
                        }
                    } else {
                        $.blockUI({message: "<h4>Processing...</h4>"});
                        form.submit();
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

                        if (height > 768 || width > 3072 || height < 128 || width < 512 || ratio < 5 || ratio > 6) {
                            $("#banner_err").text("The banner has invalid image dimensions.(min width: 512px, min height: 128px, max width: 3072px, max height: 768px, ratio: between 1:5 and 1:6)");
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

    $("body").on("click", "#imgdeletebtn", function () {
        $("#banner").val("");
        $("#banner").css("background-image", "url('')");
        $("#imgdeletebtn").css("display", "none");
        $("#remstatus").val(3);
    });

</script>
@endsection