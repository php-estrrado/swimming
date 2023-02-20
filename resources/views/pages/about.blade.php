@extends('layouts.app')
@section('title', 'About Us')

@section('content')

<div class="secsep">&nbsp;</div>

<?php
if ($active == 1) {

    if ($banner != "") {
        $bannerimage = url('/storage/uploads/admin/pages/'.$banner);
    } else {
        $bannerimage = "";
    }
    ?>
    <?php if ($bannerimage != "") { ?>
        <section id="banner">
            <div class="imgbx">
                <img src="{{$bannerimage}}" alt="" />
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
        <div class="row">
            <?php echo $content ?>
        </div>
    </section>
<?php } ?>
@endsection