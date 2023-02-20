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
<?php $userName = '';
    if(isset(auth()->user()->id)){ $userAvthar =   Session::get('userData')->avthar; $userName = Session::get('userData')->name; $prefix = ''; }
    else if(Session::get('staffData')){ $userAvthar = Session::get('staffData')->staff_avthar; $userName = Session::get('staffData')->name; $prefix = 'staff/'; }
    $notifications = getNotifications(auth()->user()->id);
?>
<div class="p-2 d-block d-sm-none navbar-sm-search">
    <!-- Form -->
    <form class="navbar-search navbar-search-dark form-inline ml-lg-auto">
        <div class="form-group mb-0">
            <div class="input-group input-group-alternative">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div><input class="form-control" placeholder="Search" type="text">
            </div>
        </div>
    </form>
</div>


<p class="statusMsg" style="margin: 0;"></p>



<!-- Top navbar -->
<nav class="navbar navbar-top  navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-toggle="sidebar" href="#"></a>
        <!-- Brand -->
        <a class="navbar-brand pt-0 d-md-none" href="index.html">
            <img src="{{asset('public/coach/assets/img/brand/logo.jpg')}}" class="navbar-brand-img" alt="...">
        </a>
        <div class="form-group mb-0">{{auth()->user()->name}}</div>
        <!-- Form -->
        <form class="navbar-search navbar-search-dark form-inline mr-3 ml-lg-auto">
            <div class="form-group mb-0">
                
<!--                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-search"></i></span>
                    </div><input class="form-control" placeholder="Search" type="text">-->
                
            </div>
        </form>
        <!-- User -->
        <ul class="navbar-nav align-items-center ">
            <li class="nav-item d-none d-md-flex">
                <div class="dropdown d-none d-md-flex mt-2 ">
                    <a class="nav-link full-screen-link pl-0 pr-0"><i class="fe fe-maximize-2 floating " id="fullscreen-button"></i></a>
                </div>
            </li>
            
            <li class="nav-item" >
                <a id="c-notify" href="{{url('coach/messages')}}" aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0">
                    <i class="fa fa-comment"></i> @if(auth()->user()->chat_notify > 0)<span class="count">{{auth()->user()->chat_notify}}</span> @endif</i>
                </a>
            </li>
            <li class="nav-item dropdown" >
                <a id="p-notify" aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0" data-toggle="dropdown" href="#" role="button">
                    <i class="fa fa-bell"></i> @if(auth()->user()->push_notify > 0)<span class="count bell">{{auth()->user()->push_notify}}</span> @endif
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        @if($notifications)
                            @foreach($notifications as $row)
                                <a class="dropdown-item" href="#"><span>{{$row->message}}</span></a>
                                <div class="dropdown-divider"></div>
                            @endforeach
                        @endif
                    </div>
                
                </a>
            </li>
            
            <li class="nav-item dropdown">
                <a aria-expanded="false" aria-haspopup="true" class="nav-link pr-md-0" data-toggle="dropdown" href="#" role="button">
                    <div class="media align-items-center">
                    
                        <span class="avatar avatar-sm rounded-circle"><img 
                        @if(!empty($userAvthar))
                        src="{{asset('/storage'.$userAvthar)}}"
                        @else
                        src="{{asset('/storage/app/public//user.png')}}"
                        @endif
                        ></span>
                        <div class="media-body ml-2 d-none d-lg-block"><span class="mb-0 "><?php echo $userName?></span></div>
                    </div></a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                    </div>
                    @if(isset(auth()->user()->id))
                        <a class="dropdown-item" href="{{ url('/coach/profile') }}"><i class="fa fa-user"></i> <span>My Account</span></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item"  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn">
                            <i class="fa fa-power-off"></i><span>Logout</span>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endif
                </div>
            </li>
        </ul>
    </div>
    <?php // echo '<pre>'; print_r($notifications); echo '</pre>'; ?>
</nav>
<!-- Top navbar-->
<script type="text/javascript">
    //$(".statusMsg").delay(5000).slideUp(3000); 
    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    $(document).ready(function(){
    $(".statusMsg").hide();
        setTimeout(function(){ $('.alert').hide('slow'); }, 3000 );
        setTimeout(function(){ $('.statusMsg').hide('slow'); }, 3000 );
        $('#c-notify').on('click',function(){ updateNotify('#c-notify','{{auth()->user()->id}}','users','chat_notify',0); });
        $('#p-notify').on('click',function(){ updateNotify('#p-notify','{{auth()->user()->id}}','users','push_notify',0); });
            
            
    });
    function updateNotify(dataId,userId,table,field,val){
        $.ajax({
            type: 'POST',
            url: '{{url("/coach/update/notify")}}',
            data: {id: userId,table: table,field: field,value: val},
            success: function (data) { $(dataId+' .count').css('visibility','hidden'); }
        });
    }
</script>