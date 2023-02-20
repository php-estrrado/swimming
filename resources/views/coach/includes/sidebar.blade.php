<!-- Sidebar menu-->
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar ">
    <div class="sidebar-img">
        <a class="navbar-brand" href="<?php echo $app['url']->to('/')?>"><img alt="..." class="navbar-brand-img main-logo" src="{{asset('public/coach/assets/img/brand/logo.png')}}"> <img alt="..." class="navbar-brand-img logo" src="{{asset('public/coach/assets/img/brand/logo.png')}}"></a>
        <ul class="side-menu">
            <li class="slide <?php if(isset($dashGroup)) echo $dashGroup?>">
                <a class="side-menu__item active <?php if(isset($homeMenu)) echo $homeMenu?>" href="{{url('coach/dashboard')}}"><i class="side-menu__icon fe fe-home"></i><span class="side-menu__label">Dashboard</span></a>
            </li>
            <li class="slide <?php if(isset($studentGroup)) echo $studentGroup?>">
                <a class="side-menu__item <?php if(isset($studentMenu)) echo $studentMenu?>" href="{{url('coach/students')}}"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Students</span></a>
            </li>
             <li class="slide <?php if(isset($courseGroup)) echo $courseGroup?>">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-graduation-cap"></i><span class="side-menu__label">Course Management</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('coach/courses')}}" class="slide-item  <?php if(isset($courseMenu)) echo $courseMenu?>">Registered Courses</a>
                    </li>
                    <li>
                        <a href="{{url('coach/assigned/courses')}}" class="slide-item  <?php if(isset($sActMenu)) echo $sActMenu?>">Assigned Courses</a>
                    </li>
                    <li>
                        <a href="{{url('coach/submitted/activities')}}" class="slide-item  <?php if(isset($sActMenu)) echo $sActMenu?>">Submitted Activities</a>
                    </li>
                    <li>
                        <a href="{{url('coach/activity/session/requests')}}" class="slide-item  <?php if(isset($sessionMenu)) echo $sessionMenu?>">Session Requests</a>
                    </li>
                </ul>
             </li>
             <li class="slide <?php if(isset($chatGroup)) echo $chatGroup?>">
                <a class="side-menu__item <?php if(isset($chatMenu)) echo $chatMenu?>" href="{{url('coach/messages')}}"><i class="side-menu__icon fe fe-users"></i><span class="side-menu__label">Messages</span></a>
            </li>
            
            
        </ul>
    </div>
</aside>
<!-- Sidebar menu-->

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){ $('#side-menu .slide.active').addClass('is-expanded'); },500);
    });
</script>