@extends('layouts.master')

@section('breadcrumb')
<nav class="breadcrumbs">
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
    @if(count($pro_cate) != 0)
        <div id='content' class='col-md-9 col-sm-9'>
            @yield('content_right')
        </div>

    @else
        <div class="col-md-3 col-sm-3"></div>
        <div class="col-md-7 col-sm-7">
            <div class="alert alert-info">
                <p>Không tìm thấy sản phẩm phù hợp!!!</p>
            </div>
        </div>
    @endif
</div>
@stop