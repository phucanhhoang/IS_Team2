<?php
/*layout chung trong project
 *gom co
 		header
 			--logo
 			--signin, signout
 			--navigator
 		body
 			--sidebar --content
 		footer
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css"
          href="{{asset('assets/css/font-awesome/css/font-awesome.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/bootstrap/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/jquery-ui.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/css.css')}}"/>

    @yield('style')
</head>
<body>
<!-- <input type="hidden" id="_token" name='_token' value="{{ csrf_token() }}"/> -->

<!--header outside class container because header in full screens-->
@include('partials.header')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    <a href="{{asset('/')}}">Áo</a>
    <span class="divider">›</span>
    Áo sơ mi
</nav>

{{-- Content --}}
<div class="container">
    <!--sidebar content-->
    @include('partials.sidebar')
    <!--main content-->
    <div id='content' class='col-md-9 col-sm-9'>
        @yield('content')
    </div>
</div>

{{-- Footer --}}
@include('partials.footer')
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/jquery/jquery-ui.js')}}"/></script>
<script type="text/javascript" src="{{asset('assets/js/back-to-top.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/js/site.js')}}" ></script>

@yield('javascript')


</body>
</html>