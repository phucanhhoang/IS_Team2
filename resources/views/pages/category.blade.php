@extends('layouts.category_layout')
@section('title')
    Stylitics - Category page
@stop

@section('breadcrumbs')
    @if($parent_id == 0)
        <a href="{{asset('/')}}">{!! $name_cate !!}</a>
    @else
        <a href="{{asset('/category/'.$parent_id)}}">{!! $parent_name !!}</a>
        <span class="divider">›</span>
        {!! $name_cate !!}
    @endif
@stop

@section('sort')

    <div class="dropdown">
        <button id="sort-button" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
             <span class="sort_title">{{ $title }}</span>
             <span class="caret" style="margin-left: 20px;"></span>
        </button>
        <ul class="dropdown-menu" id="menu-sort">
            <li><a href="{{ asset('category/'.$cate_id.'/sort/1') }}">Tên: A đến Z</a></li>
            <li><a href="{{ asset('category/'.$cate_id.'/sort/2') }}">Tên: Z đến A</a></li>
            <li><a href="{{ asset('category/'.$cate_id.'/sort/3') }}">Giá: Cao đến thấp</a></li>
            <li><a href="{{ asset('category/'.$cate_id.'/sort/4') }}">Giá: Thấp đến cao</a></li>
        </ul>
    </div>
@stop

@section('content_right')
<!--    <img src="{{asset('assets/image/aosomi.jpg')}}" style="max-width: 100%; max-height: 100%;margin-bottom: 25px;" /> -->
    <div class="heading-2">
        <span class="title-arrow">
            <span class="title-text">{!! mb_strtoupper($name_cate) !!}</span>
        </span>
    </div>
    <div id="product">
            @foreach($pro_cate as $pro)
                <div class="col-sm-4 col-md-4 product">
                    <div class="p-img">
                        <a href="{{asset('product/'.$pro->id)}}"><img src="{{asset('upload/images/'.$pro->image)}}"/></a>
                        <a href="#" class="icon-cart"><i class="fa fa-shopping-bag fa-1-2"></i></a>
                    </div>
                    <div class="p-title">
                        @if($pro->discount > 0)
                        <div class="div-row">
                            <span class="sale-label">SALE</span>
                            <span class="price-new pull-right">{{number_format($pro->price - $pro->price*$pro->discount/100, 0, ',', '.')}} đ</span>
                        </div>
                        <div class="div-row">
                            <span class="p-name pull-left">{{$pro->pro_name}}</span>
                            <span class="price-old pull-right">{{number_format($pro->price, 0, ',', '.')}} đ</span>
                        </div>
                        @else
                        <div class="div-row">
                            <span class="p-name">{{$pro->pro_name}}</span>
                            <span class="price-new pull-right">{{number_format($pro->price, 0, ',', '.')}} đ</span>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
    </div>
@stop

@section('javascript')

@stop
