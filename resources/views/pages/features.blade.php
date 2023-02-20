@extends('layouts.app')
@section('title', 'Features')

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
                        <a href="{{ url('/') }}">Home</a><i>-</i>
                        <span><?php echo $title ?></span>
                    </p>
                </div>
            </div>
        </section>
    <?php } ?>
    <section id="content" class="section">
        <div class="col-12 nopad graybg pt-5 pb-5">
            <div class="container"><div class="row"><?php echo str_replace("{{ url('/') }}", $app['url']->to('/'), $content) ?></div></div>
        </div>
    </section>
<?php } ?>
@endsection
