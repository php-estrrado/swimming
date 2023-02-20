@extends('layouts.app')
@section('title', 'Contact Us')

@section('content')
<?php
if ($active == 1) {

    if ($banner != "") {
        $bannerimage = getSiteUrl() . "storage/uploads/admin/pages/" . $banner;
    } else {
        $bannerimage = "";
    }
    ?>
    <?php if ($bannerimage != "") { ?>
        <section id="banner">
            <div class="imgbx">
                <img src="<?php echo $bannerimage; ?>" alt="" />
                <div class="bannertxt">
                    <h2><?php echo $title ?></h2>
                    <p>
                        <a href="">Home</a><i>-</i>
                        <span><?php echo $title ?></span>
                    </p>
                </div>
            </div>
        </section>
    <?php } ?>
    <section id="content" class="section">

        <div class="col-12 nopad graybg pt-5 pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="col-12 quickhelp">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="form-area col-12">
                            <form role="form" name="contact-form" id="contact-form" method="POST" action="{{url('saveContact')}}">
                                <h4 class="mb-4">SEND US A MESSAGE</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                                    @if ($errors->has('name'))
                                    <span class="error">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                    @if ($errors->has('email'))
                                    <span class="error">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject">
                                    @if ($errors->has('subject'))
                                    <span class="error">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" type="textarea" name="message" id="message" placeholder="Message" maxlength="1000" rows="5"></textarea>
                                    @if ($errors->has('message'))
                                    <span class="error">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                                {{ csrf_field() }}
                                <button type="submit" id="submit" name="submit" class="btn btn-theme pull-right">Submit Form</button>
                            </form>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div id="map" class="row">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.9488226235612!2d79.85282101482298!3d6.8967249206251475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae25bdfa73a1b7b%3A0x9ac04d5c336181cd!2s1+Temple+Ln%2C+Colombo+00300%2C+Sri+Lanka!5e0!3m2!1sen!2sin!4v1551079479117" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>
    </section>
<?php } ?>
<script src="{{asset('public/bizzadmin/assets/plugins/jquery-validation/dist/jquery.validate.min.js')}}"></script>
<script src="{{asset('public/bizzadmin/assets/js/jquery.blockUI.js')}}"></script>
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {

    $.validator.methods.email = function (value, element) {
        return this.optional(element) || /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/.test(value);
    };

    var validator = $("#contact-form").validate({
        ignore: ":hidden",
        rules: {
            name: {
                required: true,
                maxlength: 55
            },
            subject: {
                required: true,
                maxlength: 255
            },
            email: {
                required: true,
                email: true,
                maxlength: 55
            },
            message: {
                required: true,
                maxlength: 1000
            }
        },
        messages: {
            name: {
                required: "The name field is required.",
                maxlength: "The maximum length for name is 55."
            },
            subject: {
                required: "The subject field is required.",
                maxlength: "The maximum length for subject is 255."
            },
            email: {
                required: "The email field is required.",
                email: "The email must be a valid email address.",
                maxlength: "The maximum length for email is 55."
            },
            message: {
                required: "The message field is required.",
                maxlength: "The maximum length for message is 1000."
            }
        },
        submitHandler: function (form) {

            $.blockUI({message: "<h4>Processing...</h4>"});
            form.submit();
        }
    });

});

</script>
@endsection
