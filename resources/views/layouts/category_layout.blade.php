@extends('layouts.master')

@section('breadcrumb')
<div class="row">
    <div class="col-md-8 col-sm-8">
        <nav class="container breadcrumbs">
            <a href="{{asset('/')}}">Trang chủ</a>
            <span class="divider">›</span>
            @yield('breadcrumbs')
        </nav>
    </div>
    <div class="col-md-4 col-sm-4" id="sort">
        @yield('sort')
    </div>
</div>
@stop
    
@section('content')
<div class="container">
    <!--sidebar content-->
    @include('partials.sidebar')
    <!--main content-->
    <div id='content' class='col-md-9 col-sm-9'>
        @yield('content_right')
    </div>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-md-8 col-sm-8">
        	<div class="pagination pull-right">
    	        <li><a href="#"> < </a></li>
    	        @for($i = 1; $i<= $pro_cate->lastPage(); $i = $i + 1)
    	            <li class="{!! ($pro_cate->currentPage() == $i) ? 'active' : '' !!}">
    	            	<a href="{!! $pro_cate->url($i) !!}">{{ $i }}</a>
    	            </li>
    	        @endfor
    	        <li><a href="#"> > </a></li>
    	    </div>
        </div>
    </div>
</div>
@stop