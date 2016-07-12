@extends('layout')
@section('title')
HomePage
@stop

@section('content')
<div class="col-12">
    <div class='slide'>
        <div class='slide-image'>
            <a href="#"><img src="{{asset('../resources/assets/image/slide-1.jpg')}}"/></a>
            <a href="#"><img src="{{asset('../resources/assets/image/slide-2.png')}}"/></a>
            <a href="#"><img src="{{asset('../resources/assets/image/slide-3.jpg')}}"/></a>
        </div>

        <ul class='slide-bullet'></ul>
    </div>
</div>
<div class="elements col-12">
    <div class="col-4 left">
        <a href="#"><img src="{{asset('../resources/assets/image/slide-nu.jpg')}}"/><span>NỮ</span></a>
        <div class="policy"><p><span style="vertical-align:middle">MIỄN PHÍ GIAO HÀNG<br/><span>với hóa đơn trên 500.000đ</span></span>
            </p></div>
    </div>

    <div class="col-4 middle">
        <a href="#"><img src="{{asset('../resources/assets/image/slide-nam.jpg')}}"/><span>NAM<br/><span>Xem ngay</span></span></a>
    </div>

    <div class="col-4 right">
        <a href="#"><img src="{{asset('../resources/assets/image/slide-phukien.jpg')}}"/><span>PHỤ KIỆN</span></a>
        <div class="policy"><p><span style="vertical-align:middle">ĐỔI TRẢ<br/><span>trong vòng 3 ngày</span></span></p>
        </div>
    </div>
</div>

<div class="list-products col-12">
    <p><span>SẢN PHẨM MỚI</span></p>
    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>

    <div class="col-3 product">
        <div>
            <a href="#"><img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/></a>
            <a href="#" class="icon-cart"><img src="{{asset('../resources/assets/image/icon/icon-cart.png')}}"
                                               width="25px" height="25px"><span>Thêm vào giỏ hàng</span></a>
        </div>
        <p style="margin-top:20px;">Áo phông BU cải<br/><span>200.000đ</span></p>
    </div>
</div>
@stop

@section('javascript')

@stop