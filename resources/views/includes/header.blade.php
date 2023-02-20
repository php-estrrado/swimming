@if(Session::has('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
        {{ Session::get('success')  }}
    </div>
@endif
@if(Session::has('warning'))
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
        {{ Session::get('warning')  }}
    </div>
@endif
@if(Session::has('error'))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
        {{ Session::get('error')  }}
    </div>
@endif
<header id="header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <div class="container">
        <div class="col-12">
            <div class="row pt-3 pb-3">
                <div class="col-lg-3 col-md-2 col-sm-12 col-12">
                    <div class="logo">
                        <a href="<?php echo $app['url']->to('/')?>"><img src="<?php echo $app['url']->to('/public/images/tp_logo.png')?>" alt="" /></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div id="main-nav" class="stellarnav">
                        <ul class="nav-main">
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About</a></li>
                            <li><a href="{{ route('course')}}">Courses</a></li>
                            <li><a href="{{ route('location')}}">Locations</a></li>
                           
                            @guest
                            <li><a href="{{ url('/register') }}" class="">Coach Registration</a></li>
                                <li><a href="{{ route('login') }}">Coach Login</a></li>
                                
                            @else
                                <li><a href="">{{auth()->user()->name}}</a>
                                     <ul>
                                         <li><a href="{{ $app['url']->to('coach/dashboard') }}">Dashboard</a></li>
                                         <li><a href="{{ $app['url']->to('coach/profile') }}">Profile</a></li>
                                         <li><a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="">Logout</a></li> 
                                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                             @csrf
                                         </form>
                                     </ul>
                                 </li>
                            @endguest
                        </ul>
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- <div class="col-lg-3 col-md-3 col-sm-12 col-12">
                    <div class="loginbx">
                        <ul>
                            <li><a href="" class="btn">Login</a></li>
                            <li><a href="" class="btn">Logout</a></li>
                            <li><a href="" class="btn btn-theme btntrial">Free Trial</a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</header>

<script type="text/javascript">
    $(document).ready(function(){
        setTimeout(function(){ $('.alert').hide('slow'); }, 3000 );
        
    });
</script>
