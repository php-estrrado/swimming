
<!DOCTYPE html>
<html lang="en">
    @include('includes.head')
<body class="<?php if(Route::currentRouteName() == 'pricing'){ echo 'pricing'; }?>">
    <div class="outer">
        @include('includes.header')
        @yield('content')
        @include('includes.footer')
    </div>
</body>

</html>