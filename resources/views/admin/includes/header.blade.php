<div class="p-2 d-block d-sm-none navbar-sm-search">
    <!-- Form -->
    <form class="navbar-search navbar-search-dark form-inline ml-lg-auto">
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div><input disabled="disabled" class="form-control" placeholder="Search" type="text">
            </div>
        </div>
    </form>
</div>
<?php $userdata = getAuthDetails(); ?>
<p class="statusMsg" style="margin: 0;"></p>
<!-- Top navbar -->
<nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
        <!-- Brand -->
        <a class="navbar-brand pt-0 d-md-none" href="{{url('admin/dashboard')}}">
            <img src="{{asset('public/bizzadmin/assets/img/brand/logo.png')}}" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="navbar-nav align-items-center ">
            <li class="nav-item dropdown">
                <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0" data-toggle="dropdown" href="#" role="button">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 ">{{auth()->user()->name}}</span>
                        </div>
                    </div></a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <a class="dropdown-item" href="{{url('admin/profile')}}"><i class="fa fa-user"></i> <span>My profile</span></a>
                    <!--<a class="dropdown-item" href="#"><i class="fa fa-gear"></i> <span>Settings</span></a>-->
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="{{url('admin/logout')}}"><i class="fa fa-power-off"></i> <span>Logout</span></a>
                </div>
            </li>
        </ul>
    </div>
</nav>