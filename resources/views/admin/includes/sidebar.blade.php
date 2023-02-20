<!-- Sidebar menu-->
<?php 
    $userGroups = $courseGroup = '';
    $currPage       = Route::currentRouteName();
    $controller     =   explode('@',str_replace('App\Http\Controllers\Admin', '',request()->route()->getAction('controller')));
 ?>
<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar ">
    <div class="sidebar-img">
        <a class="navbar-brand" href="{{url('admin')}}"><img alt="" class="navbar-brand-img main-logo" src="{{asset('public/bizzadmin/assets/img/brand/logo.png')}}"> <img alt="" class="navbar-brand-img logo" src="{{asset('public/admin/assets/img/brand/logo.png')}}"></a>
        <ul id="side-menu" class="side-menu">
            <li id="" class="slide <?php if(isset($dashGroup)) echo $dashGroup?>">
                <a class="side-menu__item  <?php if(isset($homeMenu)) echo $homeMenu?>" href="{{url('admin')}}"><i class="side-menu__icon fa fa-home"></i><span class="side-menu__label">Dashboard </span></a>
            </li>
            
            
            
            
            
            <li class="slide <?php if(isset($userGroup)) echo $userGroup?>">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-users"></i><span class="side-menu__label">User Management</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('admin/user/coaches/new')}}" class="slide-item <?php if(isset($coachARMenu)) echo $coachARMenu?>">Coach Approval Requests</a>
                    </li>
                    <li>
                        <a href="{{url('admin/user/coaches')}}" class="slide-item <?php if(isset($coachMenu)) echo $coachMenu?>">Coaches</a>
                    </li>
                    <li>
                        <a href="{{url('admin/user/students')}}" class="slide-item  <?php if(isset($studentMenu)) echo $studentMenu?>">Users</a>
                    </li>
                </ul>
            </li>
            
            
            <li class="slide <?php if(isset($coursesGroup)) echo $coursesGroup?>">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-graduation-cap"></i><span class="side-menu__label">Course Management</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('admin/courses')}}" class="slide-item  <?php if(isset($courseMenu)) echo $courseMenu?>">Courses</a>
                    </li>
                    <li>
                        <a href="{{url('admin/registered/courses')}}" class="slide-item  <?php if(isset($regCourseMenu)) echo $regCourseMenu?>">Registered Courses</a>
                    </li>
                    <li>
                        <a href="{{url('admin/courses/approvel/pending')}}" class="slide-item  <?php if(isset($penAppMenu)) echo $penAppMenu?>">Pending for Approval</a>
                    </li>
                    <li>
                        <a href="{{url('admin/activity/session/requests')}}" class="slide-item  <?php if(isset($sessioneMenu)) echo $sessioneMenu?>">Extra Session Requests</a>
                    </li>
                    <li>
                        <a href="{{url('admin/course/badges')}}" class="slide-item <?php if(isset($badgesMenu)) echo $badgesMenu?>">Badges</a>
                    </li>
                </ul>
            </li>
          
            <li class="slide <?php if(isset($locationsGroup)) echo $locationsGroup?>">
                <a class="side-menu__item" href="{{url('admin/locations')}}"><i class="side-menu__icon fa fa-map-marker"></i><span class="side-menu__label">Locations</span></a>
            </li>
           
            <li class="slide <?php if(isset($delGroup)) echo $delGroup?>">
                <a class="side-menu__item" data-toggle="slide" href="#"><i class="side-menu__icon fa fa-trash"></i><span class="side-menu__label">Disabled User Management</span><i class="angle fa fa-angle-right"></i></a>
                <ul class="slide-menu">
                    <li>
                        <a href="{{url('admin/user/disabled/coaches')}}" class="slide-item <?php if(isset($delCoachMenu)) echo $delCoachMenu?>">Disabled Coaches</a>
                    </li>
                    <li>
                        <a href="{{url('admin/user/disabled/students')}}" class="slide-item  <?php if(isset($delStudMenu)) echo $delStudMenu?>">Disabled Students</a>
                    </li>
                </ul>
            </li>
          
            
        </ul>
    </div>
</aside>
<!-- Sidebar menu-->

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){ $('#side-menu .slide.active').addClass('is-expanded') },500);
    });
</script>