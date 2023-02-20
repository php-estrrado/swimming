<head>
    <!-- meta -->
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="analytics for the office of the CFO" />
    <!-- meta -->
    <!-- title -->
    <title>{{ config('app.name', 'Bizz Salon') }} - @yield('title')</title>
    <!-- title -->
    <link href="{{asset('public/images/favicon.png')}}" rel="icon" type="image/png">
    <!-- custom css -->
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/style.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/bootstrap.css') ?>" type="text/css">
    
    
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/stellarnav.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/font-awesome.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/custom.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/main.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?php echo $app['url']->to('/public/css/mobile.css') ?>" type="text/css">
    
    <!-- jquery -->
    <script type='text/javascript' src="<?php echo $app['url']->to('/public/js/jquery-min.js') ?>"></script>
    <script type='text/javascript' src="<?php echo $app['url']->to('/public/js/bootstrap.js') ?>"></script>
    <script type='text/javascript' src="<?php echo $app['url']->to('/public/js/stellarnav.js') ?>"></script>
    <script type="text/javascript" src="<?php echo $app['url']->to('/public/js/custom-script.js') ?>"></script>
    <script src="{{asset('public/js/intlInputPhone.js')}}"></script>
    <!-- jquery -->
</head>

