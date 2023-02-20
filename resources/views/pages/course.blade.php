
@extends('layouts.app')
@section('title', 'Courses')

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