@extends('layouts.app')
@section('title', 'Support')

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
                    <h2>Hi! How can we help?</h2>
                    <form class="serachgbl mb-2 mt-3">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search our help center" required="">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="submit" name="" class="submit"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </form>
                    <p>
                        <a href="{{ url('/') }}">Home</a><i>-</i>
                        <span><?php echo $title ?></span>
                    </p>
                </div>
            </div>
        </section>
    <?php } ?>
    <section id="content" class="section">
        <div class="col-12 nopad graybg">
            <div class="container">
                <div class="row">
                    <div class="graybg pt-5 pb-5 txtbx col-12 secsprt">
                        <?php echo $content ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mb-5 mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="mb-4"><i class="fa fa-question-circle"></i> FAQ</h3>
                    </div>
                    <?php
                    if ($faqs) {
                        $halfcnt = (count($faqs) / 2) + 1;
                        ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <ul class="listcmn">
                                <?php
                                $i = 1;
                                foreach ($faqs as $faq) {
                                    if ($i <= $halfcnt) {
                                        ?>
                                        <li><?php echo $faq->question; ?>
                                            <small><?php echo "A. " . $faq->answer; ?></small></li>
                                        <?php
                                    }
                                    $i++;
                                }
                                ?>                    
                            </ul>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <ul class="listcmn">

                                <?php
                                $i = 1;
                                foreach ($faqs as $faq) {
                                    if ($i > $halfcnt) {
                                        ?>
                                        <li><?php echo $faq->question; ?>
                                            <small><?php echo "A. " . $faq->answer; ?></small></li>
                                        <?php
                                    }
                                    $i++;
                                }
                                ?> 

                            </ul>

                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </section>
<?php } ?>
@endsection
