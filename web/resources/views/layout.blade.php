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
    <title>@yield('title')</title>
    {{-- {{ HTML::style('/bootstrap/css/bootstrap.css'); }} --}}
    <link rel="stylesheet" type="text/css"
          href="{{asset('../resources/assets/css/font-awesome/css/font-awesome.min.css')}}"/>
    <!--    <link rel="stylesheet" type="text/css" href="{{asset('resources/assets/bootstrap/css/bootstrap.min.css')}}"/>-->
    <link rel="stylesheet" type="text/css" href="{{asset('../resources/views/templateHTML/css/css.css')}}"/>

    @yield('style')
</head>
<body>
<!-- <input type="hidden" id="_token" name='_token' value="{{ csrf_token() }}"/> -->

<!--header outside class container because header in full screens-->
@include('include.header')

<!--nav responsive-->
@include('include.nav')
{{-- Content --}}
    <!--sidebar content-->
    <!-- <div id="sidebar" class='col-md-3 col-sm-3 hidden-xs'>@include('include.sidebar')</div> -->

    <!--main content-->
    <!-- <div id='content' class='col-md-9 col-sm-9'> -->
    @yield('content')
    <!-- </div> -->

{{-- Footer --}}
@include('include.footer')
<script type="text/javascript" src="{{asset('../resources/assets/js/jquery/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('../resources/views/templateHTML/jquery/jquery.js')}}"></script>
@yield('javascript')


</body>
</html>