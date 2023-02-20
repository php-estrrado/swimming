<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    @include('coach.includes.head')
    <body class="app sidebar-mini rtl" >
        <div id="global-loader" ></div>
        <div class="page">
            <div class="page-main">
                    @include('coach.includes.sidebar')
                <!-- app-content-->
                <div class="app-content ">
                    <div class="side-app">
                        <div class="main-content">
                            @include('coach.includes.header')
                            <!-- Page content -->
                            <div class="container-fluid pt-8">
                                @yield('content')
                                @include('coach.includes.footer')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- app-content-->
            </div>
        </div>
        @include('coach.includes.foot')
    </body>
</html>