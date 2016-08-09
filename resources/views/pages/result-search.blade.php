@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Kết quả tìm kiếm
</nav>
@stop

@section('content')
<div class="list-products" id="list_products">
    <h4>Có {{$pros->count()}} sản phẩm phù hợp với từ khóa "{{$keyword}}"</h4>
<!--    <div class="heading"><span>SẢN PHẨM</span></div>-->
    @foreach($pros as $pro)
    <div class="col-md-3 col-xs-12 product">
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
<script>

</script>
@stop