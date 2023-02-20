<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar ">
    <div class="sidebar-img">
        <a class="navbar-brand" href="{{url('admin')}}"><img alt="" class="navbar-brand-img main-logo" src="{{asset('public/bizzadmin/assets/img/brand/logo.png')}}"> <img alt="" class="navbar-brand-img logo" src="{{asset('public/admin/assets/img/brand/logo.png')}}"></a>
        <ul class="side-menu">
            <li class="slide">
                <a class="side-menu__item active" href="{{url('admin')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Users</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('admin/users/students')}}" class="slide-item">Students</a>
                    </li>
                    <li>
                        <a href="{{url('admin/users/coaches')}}" class="slide-item">Coaches</a>
                    </li>
                </ul>
            </li>
            <li class="slide">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-graduation-cap"></i><span class="side-menu__label">Courses</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('admin/courses')}}" class="slide-item">Courses</a>
                    </li>
                    <li>
                        <a href="{{url('admin/locations')}}" class="slide-item">Locations</a>
                    </li>
                </ul>
            </li>
            
            
        </ul>
    </div>
</aside>
<!-- Sidebar menu-->