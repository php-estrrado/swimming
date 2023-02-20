<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="ltr">
    @include('admin.includes.head')
    <body class="app sidebar-mini rtl" >
        <div id="global-loader" ></div>
        <div class="page">
            <div class="page-main">
                @include('admin.includes.sidebar')
                <!-- app-content-->
                <div class="app-content ">
                    <div class="side-app">
                        <div class="main-content">
                            @include('admin.includes.flash')
                            @include('admin.includes.header')
                            <!-- Page content -->
                            <div class="container-fluid pt-8">
                                @yield('content')
                                @include('admin.includes.footer')
                            </div>
                        </div>
                    </div>
                </div>
                <!-- app-content-->
            </div>
        </div>
        @include('admin.includes.foot')
    </body>
</html>