@extends('layouts.category_layout')
@section('title')
    Stylitics - Category page
@stop

@section('breadcrumbs')
    @if($cate_id == 1 || $cate_id == 4 || $cate_id == 7)
        <a href="{{asset('/')}}">{!! $name_cate !!}</a>
    @elseif($cate_id == 2 || $cate_id == 3)
        <a href="{{asset('/category/1/Áo')}}">Áo</a>
        <span class="divider">›</span>
        {!! $name_cate !!}
    @elseif($cate_id == 5 || $cate_id == 6)
        <a href="{{asset('/category/4/Váy')}}">Váy</a>
        <span class="divider">›</span>
        {!! $name_cate !!}
    @elseif($cate_id == 8 || $cate_id == 9)
        <a href="{{asset('/category/7/Quần')}}">Quần</a>
        <span class="divider">›</span>
        {!! $name_cate !!}
    @endif
@stop
@section('content')
<!--    <img src="{{asset('assets/image/aosomi.jpg')}}" style="max-width: 100%; max-height: 100%;margin-bottom: 25px;" /> -->
    @foreach($pro_cate as $pro)
        <div class="col-sm-3 col-md-3 product">
            <div class="p-img">
                <a href="{{asset('product/'.$pro->id)}}"><img src="{{asset('upload/images/'.$pro->image)}}"/></a>
                <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>
            </div>
            <div class="p-title">
                <div class="div-row">
                    <span class="p-name">{{$pro->pro_name}}</span>
                    <span class="price-new pull-right">{{number_format($pro->price, 0, ',', '.')}}đ</span>
                </div>
            </div>
        </div>
    @endforeach
@stop

@section('javascript')

@stop