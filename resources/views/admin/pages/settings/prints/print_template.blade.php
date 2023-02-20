@extends('admin.layouts.app')
@section('title', 'Print Template')
@section('content')
<?php
$na = "";
$id             =   ($print) ? $print->id : 0;
$name           =   ($print) ? $print->title : $na;
$identifier     =   ($print) ? $print->identifier : $na;
$content        =   ($print) ? $print->content : $na;
$status         =   ($print) ? $print->status : 1;

?>
<script type="text/javascript" src="{{asset('public/bizzadmin/assets/js/tinymce.min.js')}}"></script>
<div class="container-fluidd pt-88">
    <div class="page-header mt-0 shadow p-3">
        <ol class="breadcrumb mb-sm-0">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{url('admin/settings/prints')}}">Print Templates</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $title ?></li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="mb-0"><?php  echo $title ?></h2>
                </div>
                <div class="card-body">
                    {{ Form::open(array('url' => "admin/settings/print/save", 'id' => 'printTemplateForm', 'name' => 'printTemplateForm', 'class' => '')) }}
                    {{Form::hidden('id',$id,['id'=>'id'])}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('title', 'Title', ['class' => 'control-label']) }}
                                <?php echo Form::text('title', $name, ['class' => 'form-control']) ?>
                                @if ($errors->has('title'))
                                <span class="error">{{ $errors->first('title') }}</span>
                                @endif
                                <span id="title_err" class="error"></span>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="clr"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('identifier', 'Identifier', ['class' => 'control-label']) }}
                                <input type="text" class="form-control" name="identifier" id="identifier" value="{{$identifier}}">
                                @if ($errors->has('identifier'))
                                <span class="error">{{ $errors->first('identifier') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="clr"></div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label('content', 'Template', ['class' => 'control-label']) }}
                                <?php echo Form::textarea('content', $content, ['id' => 'content', 'class' => 'form-control editor','rows'=>20]) ?>
                                @if ($errors->has('content'))
                                <span class="error">{{ $errors->first('content') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="clr"></div>
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ Form::label('status', 'Status', ['class' => 'control-label']) }}
                                <?php echo Form::select('status', [0 => 'Disable', 1 => 'Enable'], $status, ['class' => 'form-control']) ?>
                                @if ($errors->has('status'))
                                <span class="error">{{ $errors->first('status') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 ">
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
<style> #content_ifr{ min-height: 400px !important; } </style>
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
      //  var baseurl = $("#baseurl").val();
        window.location.href = '{{url("admin/settings/prints")}}';
    });


});
</script>
@endsection