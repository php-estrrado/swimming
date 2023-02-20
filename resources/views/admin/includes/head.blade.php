<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta content="" name="description">
    <meta content="saloon &amp; spa" name="BizzSaloon">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- Title -->
    <title>{{ config('app.name', 'BizzSalon') }} - @yield('title')</title>

    <!-- Favicon -->
    <link href="{{asset('public/bizzadmin/assets/img/brand/favicon.png')}}" rel="icon" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800" rel="stylesheet">

    <!-- Icons -->
    <link href="{{asset('public/bizzadmin/assets/css/icons.css')}}" rel="stylesheet">

    <!--Bootstrap.min css-->
    <link rel="stylesheet" href="{{asset('public/bizzadmin/assets/plugins/bootstrap/css/bootstrap.min.css')}}">

    <!-- Ansta CSS -->
    <link href="{{asset('public/bizzadmin/assets/css/left-style-dashboard.css')}}" rel="stylesheet" type="text/css">

    <!-- Tabs CSS -->
    <link href="{{asset('public/bizzadmin/assets/plugins/tabs/style.css')}}" rel="stylesheet" type="text/css">

    <!-- jvectormap CSS -->
    <link href="{{asset('public/bizzadmin/assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="{{asset('public/bizzadmin/assets/plugins/customscroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{asset('public/bizzadmin/assets/plugins/toggle-sidebar/css/fullsidemenu.css')}}" rel="stylesheet">

    <!-- Data table css -->
    <link href="{{asset('public/bizzadmin/assets/plugins/datatable/datatables.min.css')}}" rel="stylesheet" />

    <!-- Custom scroll bar css-->
    <link href="{{asset('public/bizzadmin/assets/plugins/customscroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- Custom css-->
    <link href="{{asset('public/bizzadmin/assets/css/custom.css')}}" rel="stylesheet" />

    <link rel="stylesheet" href="{{asset('public/bizzadmin/assets/css/font-awesome.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/bizzadmin/assets/css/nucleo-style.css')}}">
    <link rel="stylesheet" href="{{asset('public/bizzadmin/assets/css/sweetalert.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/bizzadmin/assets/css/custom-datatable.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/bizzadmin/assets/css/bootstrap-datetimepicker.min.css')}}" type="text/css">
    <script src="{{asset('public/bizzadmin/assets/plugins/jquery/dist/jquery.min.js')}}"></script>
    <script src="{{asset('public/bizzadmin/assets/js/sweetalert.min.js')}}"></script>
    <script src="{{asset('public/bizzadmin/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('public/bizzadmin/assets/js/moment.js')}}"></script>
    <script src="{{asset('public/bizzadmin/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
</head>