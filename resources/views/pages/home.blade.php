@extends('layouts.master')
@section('title')
Home page
@stop

@section('content')
<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <div class='carousel-inner' role="listbox">
        <div class="item active">
            <a href="#"><img src="{{asset('assets/image/slide-1.jpg')}}"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('assets/image/slide-2.png')}}"/></a>
        </div>
        <div class="item">
            <a href="#"><img src="{{asset('assets/image/slide-3.jpg')}}"/></a>
        </div>
    </div>
</div>
<div class="elements">
    <div class="col-xm-12 col-sm-4 left">
        <a href="{{asset('category/'.$cat_parents[0]->id.'/'.$cat_parents[0]->cat_title)}}"><img src="{{asset('assets/image/shirt.jpg')}}"/><span>{{mb_strtoupper($cat_parents[0]->cat_title)}}</span></a>
        <div class="policy">
            <p>
                <span>
                    <i class="fa fa-truck"></i> MIỄN PHÍ GIAO HÀNG<br/><span>với hóa đơn trên 500.000đ</span>
                </span>
            </p>
        </div>
    </div>

    <div class="col-xm-12 col-sm-4 middle">
        <a href="{{asset('category/'.$cat_parents[1]->id.'/'.$cat_parents[1]->cat_title)}}"><img src="{{asset('assets/image/dress.jpg')}}"/><span>{{mb_strtoupper($cat_parents[1]->cat_title)}}<br/></span></a>
    </div>

    <div class="col-xm-12 col-sm-4 right">
        <a href="{{asset('category/'.$cat_parents[2]->id.'/'.$cat_parents[2]->cat_title)}}"><img src="{{asset('assets/image/jean.jpg')}}"/><span>{{mb_strtoupper($cat_parents[2]->cat_title)}}</span></a>
        <div class="policy"><p><span><i class="fa fa-refresh"></i> ĐỔI TRẢ<br/><span>trong vòng 3 ngày</span></span></p>
        </div>
    </div>
</div>

<div class="list-products">
    <div class="heading"><span>SẢN PHẨM</span></div>
    @foreach($pros as $pro)
    <div class="col-md-5ths col-xs-6 product">
        <div class="p-img">
            <a href="{{asset('product/'.$pro->id)}}"><img src="{{asset('upload/images/'.$pro->image)}}"/></a>
            <a href="#" class="icon-cart" style="display: none"><i class="fa fa-shopping-basket fa-1-2"></i></a>
        </div>
        <div class="p-title">
            <div class="div-row">
                <span class="p-name">{{$pro->pro_name}}</span>
                <span class="price-new pull-right">{{number_format($pro->price, 0, ',', '.')}}đ</span>
            </div>
        </div>
    </div>
    @endforeach
</div>

<!--<div class="list-products list-p-slide">-->
<!--    <div class="heading"><span>SẢN PHẨM GIẢM GIÁ</span></div>-->
<!--    <div id="p-slider" class="carousel slide" data-ride="carousel">-->
<!--        <ol class="carousel-indicators">-->
<!--            <li data-target="#p-slider" data-slide-to="0" class="active"></li>-->
<!--            <li data-target="#p-slider" data-slide-to="1"></li>-->
<!--            <li data-target="#p-slider" data-slide-to="2"></li>-->
<!--        </ol>-->
<!---->
<!--        <div class='carousel-inner' role="listbox">-->
<!--            <div class="item active">-->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="#"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="sale-label">SALE</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name pull-left">ÁO SƠ MI</span>-->
<!--                            <span class="price-old pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="#"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="sale-label">SALE</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name pull-left">ÁO SƠ MI</span>-->
<!--                            <span class="price-old pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="#"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="sale-label">SALE</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name pull-left">ÁO SƠ MI</span>-->
<!--                            <span class="price-old pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="item">-->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="#"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="sale-label">SALE</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name pull-left">ÁO SƠ MI</span>-->
<!--                            <span class="price-old pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="col-md-5ths col-xs-6 product">-->
<!--                    <div class="p-img">-->
<!--                        <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--                        <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--                    </div>-->
<!--                    <div class="p-title">-->
<!--                        <div class="div-row">-->
<!--                            <span class="p-name">ÁO SƠ MI</span>-->
<!--                            <span class="price-new pull-right">200.000đ</span>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--        <a class="left carousel-control" href="#p-slider" role="button" data-slide="prev">-->
<!--            <span class="fa fa-angle-left" aria-hidden="true"></span>-->
<!--            <span class="sr-only">Previous</span>-->
<!--        </a>-->
<!--        <a class="right carousel-control" href="#p-slider" role="button" data-slide="next">-->
<!--            <span class="fa fa-angle-right" aria-hidden="true"></span>-->
<!--            <span class="sr-only">Next</span>-->
<!--        </a>-->
<!--    </div>-->
<!--</div>-->

<!--<div class="list-products">-->
<!--    <div class="heading"><span>SẢN PHẨM BÁN CHẠY</span></div>-->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="#"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="sale-label">SALE</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--            <div class="div-row">-->
<!--                <span class="p-name pull-left">ÁO SƠ MI</span>-->
<!--                <span class="price-old pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="{{asset('product')}}"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="p-name">ÁO SƠ MI</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!---->
<!--    <div class="col-md-5ths col-xs-6 product">-->
<!--        <div class="p-img">-->
<!--            <a href="#"><img src="{{asset('assets/image/sanpham.jpg')}}"/></a>-->
<!--            <a href="#" class="icon-cart"><i class="fa fa-shopping-basket fa-1-2"></i></a>-->
<!--        </div>-->
<!--        <div class="p-title">-->
<!--            <div class="div-row">-->
<!--                <span class="sale-label">SALE</span>-->
<!--                <span class="price-new pull-right">200.000đ</span>-->
<!--            </div>-->
<!--            <div class="div-row">-->
<!--                <span class="p-name pull-left">ÁO SƠ MI</span>-->
<!--                <span class="price-old pull-right">200.000đ</span>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
@stop

@section('javascript')

@stop