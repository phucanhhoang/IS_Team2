@extends('layout')
@section('title')
Stylitics - Home page
@stop

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class='carousel-inner' role="listbox">
        <div class="item active">
            <a href="#"><img src="{{asset('../resources/assets/image/slide-1.jpg')}}"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('../resources/assets/image/slide-2.png')}}"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('../resources/assets/image/slide-3.jpg')}}"/></a>
        </div>
    </div>
</div>
<div class="elements">
    <div class="col-xm-12 col-sm-4 left">
        <a href="#"><img src="{{asset('../resources/assets/image/shirt.jpg')}}"/><span>ÁO</span></a>
        <div class="policy"><p><span><i
                        class="fa fa-truck"></i> MIỄN PHÍ GIAO HÀNG<br/><span>với hóa đơn trên 500.000đ</span></span>
            </p></div>
    </div>

    <div class="col-xm-12 col-sm-4 middle">
        <a href="#"><img src="{{asset('../resources/assets/image/dress.jpg')}}"/><span>VÁY<br/></span></a>
    </div>

    <div class="col-xm-12 col-sm-4 right">
        <a href="#"><img src="{{asset('../resources/assets/image/jean.jpg')}}"/><span>QUẦN</span></a>
        <div class="policy"><p><span><i class="fa fa-refresh"></i> ĐỔI TRẢ<br/><span>trong vòng 3 ngày</span></span></p>
        </div>
    </div>
</div>
<div class="list-products">
    <p><span>SẢN PHẨM MỚI</span></p>
    <div class="col-sm-4 col-md-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-2x"></i></a>
        </div>
        <p style="margin-top:20px;">MIDNIGHT LOVER DRESS<br/><span>200.000đ</span></p>
    </div>

    <div class="col-sm-4 col-md-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-2x"></i></a>
        </div>
        <p style="margin-top:20px;">MIDNIGHT LOVER DRESS<br/><span>200.000đ</span></p>
    </div>

    <div class="col-sm-4 col-md-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-2x"></i></a>
        </div>
        <p style="margin-top:20px;">MIDNIGHT LOVER DRESS<br/><span>200.000đ</span></p>
    </div>

    <div class="col-sm-4 col-md-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-2x"></i></a>
        </div>
        <p style="margin-top:20px;">MIDNIGHT LOVER DRESS<br/><span>200.000đ</span></p>
    </div>
</div>
@stop

@section('javascript')

@stop