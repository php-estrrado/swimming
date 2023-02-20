<?php if ($sliders && count($sliders) > 0) { ?>
    <section id="spotlight">
        <div id="articleSlide" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner"><?php
                $n = 0;
                foreach ($sliders as $slider) {
                    if ($n == 0) {
                        $active = 'active';
                    } else {
                        $active = '';
                    } $n++;

                    $sliderbanner = $app['url']->to('/storage/uploads/admin/pages/home/banner/' . $slider->banner);
                    ?>
                    <div class="carousel-item <?php echo $active ?>">
                        <div class="col-img col-lg-12 col-md-12 col-sm-12 nopad">
                            <img class="d-block w-100" src="<?php echo $sliderbanner; ?>" alt="<?php echo $slider->title ?>">
                            <div class="container">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="caption col-12"><?php echo str_replace("{{ url('/') }}", $app['url']->to('/'), $slider->description) ?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><?php }
                ?>
            </div>
            <a class="carousel-control-prev" href="#articleSlide" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#articleSlide" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </section>
<?php }
?>