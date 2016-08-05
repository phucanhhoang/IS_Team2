@extends('layouts.category_layout')
@section('title')
    Stylitics - Category page
@stop

@section('breadcrumbs')
    @if($parent_id == 0)
        <a href="{{asset('/')}}">{!! $name_cate !!}</a>
    @else
        <a href="{{asset('/category/'.$parent_id.'/'.$parent_name)}}">{!! $parent_name !!}</a>
        <span class="divider">›</span>
        {!! $name_cate !!}
    @endif
@stop

@section('content_right')
<!--    <img src="{{asset('assets/image/aosomi.jpg')}}" style="max-width: 100%; max-height: 100%;margin-bottom: 25px;" /> -->
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
@stop

@section('javascript')

@stop
