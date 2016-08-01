@extends('layouts.master')

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    @yield('breadcrumbs')
</nav>
@stop

@section('content')
<div class="container">
    <!--sidebar content-->
    @include('partials.sidebar')
    <!--main content-->
    <div id='content' class='col-md-9 col-sm-9'>
        @yield('content_right')
    </div>
</div>
@stop