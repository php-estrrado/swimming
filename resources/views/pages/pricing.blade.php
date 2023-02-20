@extends('layouts.app')
@section('title', 'Pricing')

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
            <div class="container">
                <div class="row">
                    <div class="graybg pt-4 pb-4 txtbx col-12">

                        <h4 class="text-center mb-0 txthead">All our packages include the same set of features. Simply select the package based on the number of employees you need to manage</h4>
                        <?php
                        if ($mvalidities) {
                            ?>
                            <ul id="pills-tab" class="nav nav-pills mt-5 mb-5 pricetab" role="tablist">
                                <?php
                                $i = 0;
                                foreach ($mvalidities as $mvalidity) {
                                    if ($mvalidity->validity_type == "Yearly") {
                                        $vtype = "Annually";
                                    } else {
                                        $vtype = $mvalidity->validity_type;
                                    }
                                    if ($i == 0) {
                                        $active = "active";
                                    } else {
                                        $active = "";
                                    }
                                    ?>
                                    <li class="nav-item"><a id="<?php echo strtolower($vtype) . '-tab'; ?>" class="nav-link <?php echo $active; ?>" role="tab" href="#<?php echo strtolower($vtype); ?>" data-toggle="pill" aria-controls="<?php echo strtolower($vtype); ?>" aria-selected="true"><?php echo strtoupper($vtype); ?></a></li>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </ul>
                        <?php } ?>
                        <div id="pills-tabContent" class="tab-content">
                            <?php
                            if ($memberships) {

                                $membershipsarray = json_decode(json_encode($memberships), true);
                                $mi = $mj = $mk = $ml = 0;

                                $counted = array_count_values(array_map(function($value) {
                                            return $value["validity_type"];
                                        }, $membershipsarray));

                                $ml = $counted["Yearly"];
                                $mk = $counted["Monthly"];

                                foreach ($memberships as $membership) {
                                    if ($membership->validity_type == "Yearly") {
                                        $vtype = "Annually";
                                        $per = "year";
                                        $active = "";
                                        $mj++;
                                    } else if ($membership->validity_type == "Monthly") {
                                        $vtype = $membership->validity_type;
                                        $per = "month";
                                        $active = "active";
                                        $mi++;
                                    }
                                    ?>
                                    <?php if ($mi == 1 || $mj == 1) { ?>
                                        <div id="<?php echo strtolower($vtype); ?>" class="tab-pane fade show <?php echo $active; ?>" role="tabpanel" aria-labelledby="<?php echo strtolower($vtype) . '-tab'; ?>">
                                            <div class="row text-center">
                                            <?php } ?>
                                            <div class="col-lg-3 col-md-3 col-sm-12 col-12 princing-item">
                                                <div class="pricing-divider ">
                                                    <h4 class="text-light"><?php echo ucfirst($membership->name); ?></h4>
                                                    <h4 class="my-0 display-4 text-light font-weight-normal mb-3"><span class="h3"><?php echo getCurrencyName(); ?></span><?php echo floor($membership->price); ?><span class="h6">per <?php echo $per; ?></span></h4>
                                                </div>
                                                <div class="card-body bg-white mt-0 shadow">
                                                    <ul class="list-unstyled mb-5 position-relative pricelist">
                                                        <li><?php echo $membership->staff; ?> staff/professional (per Site)</li>
                                                        <li><small><a href="<?php echo getSiteUrl(); ?>features">All features</a></small></li>
                                                        <li>Perfect for <?php echo ucfirst($membership->name); ?> Operators</li>
                                                        <li>Free Mobile app for Owner and the staff</li>
                                                        <li class="highlight">Setup Cost <strong><?php echo getCurrencyName(); ?> - 199</strong></li>
                                                        <li class="highlight">Own Mobile app with your brand for Customers (IOS &amp; Android )<strong class="block"><?php echo getCurrencyName(); ?> - 900</strong></li>
                                                    </ul>
                                                    <button class="btn btn-lg btn-block  btn-custom signup-btn" type="button">Sign up for free</button></div>
                                            </div>
                                            <?php
                                            if ($mi == $mk || $mj == $ml) {
                                                if ($mi == $mk) {
                                                    $mi = 0;
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="baseurl" id="baseurl" value="<?php echo $app->make('url')->to('/'); ?>">
            </div>
        </div>
        <div class="col-12 pt-5 pb-5">
            <div class="row text bg-white">
                <div class="container">
                    <div class="col-12">
                        <?php echo $content; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 pb-5 pt-5 faq graybg">
            <div class="container">
                <div class="col-12">
                    <h3>FAQ ?</h3>
                    <ul>
                        <?php
                        if ($faqs) {
                            $i = 1;
                            foreach ($faqs as $faq) {
                                ?>
                                <li><strong><?php echo $faq->question; ?></strong>
                                    <small>A.<?php echo ' ' . $faq->answer; ?></small></li>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </section>
<?php } ?>
<script>
    $(document).ready(function () {
        $("body").on("click", ".signup-btn", function () {
            var baseurl = $("#baseurl").val();
            window.location.href = baseurl + '/register';
        });
    });
</script>
@endsection
