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
        <a href="{{asset('category/'.$cat_parents[0]->id)}}"><img src="{{asset('assets/image/shirt.jpg')}}"/><span>{{mb_strtoupper($cat_parents[0]->cat_title)}}</span></a>
        <div class="policy">
            <p>
                <span>
                    <i class="fa fa-truck"></i> MIỄN PHÍ GIAO HÀNG<br/><span>với hóa đơn trên 500.000đ</span>
                </span>
            </p>
        </div>
    </div>

    <div class="col-xm-12 col-sm-4 middle">
        <a href="{{asset('category/'.$cat_parents[1]->id)}}"><img src="{{asset('assets/image/dress.jpg')}}"/><span>{{mb_strtoupper($cat_parents[1]->cat_title)}}<br/></span></a>
    </div>

    <div class="col-xm-12 col-sm-4 right">
        <a href="{{asset('category/'.$cat_parents[2]->id)}}"><img src="{{asset('assets/image/jean.jpg')}}"/><span>{{mb_strtoupper($cat_parents[2]->cat_title)}}</span></a>
        <div class="policy"><p><span><i class="fa fa-refresh"></i> ĐỔI TRẢ<br/><span>trong vòng 3 ngày</span></span></p>
        </div>
    </div>
</div>

<div class="list-products" id="list_products">
    <div class="heading"><span>SẢN PHẨM</span></div>
    @foreach($pros as $pro)
    <div class="col-md-3 col-xs-12 product">
        <div class="p-img">
            <a href="{{asset('product/'.$pro->id)}}"><img src="{{asset('upload/images/'.$pro->image)}}"/></a>
            <a href='#' id="{{$pro->id}}" data-toggle='modal' data-target='#product_modal' onclick='quickViewClick(this);' class='icon-cart'><i class="fa fa-shopping-bag fa-1-2"></i></a>
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

<div id="loading" style='text-align:center;display:none'><img src="{{asset('assets/image/loading.gif')}}" /></div>


@stop

@section('javascript')
<script>
    $(document).ready(function(){
        var times = 0;
        $(window).scroll(function() {
            if($(window).scrollTop() == $(document).height() - $(window).height()) {
                times++;
                $.ajax({
                    type: 'POST',
                    url: "{{asset('load-product')}}",
                    data: {times: times},
                    success: function(data){
                        console.log(data['show_loading']);
                        if(data['show_loading'] == 'true'){
                            $('#loading').show();
                            setTimeout(function(){
                                if(data['products'] != null){
                                    for(var i = 0; i < data['products'].length; i++){
                                        var url_product = "{{asset('product')}}" + "/" + data['products'][i].id;
                                        var url_img = "{{asset('upload/images')}}" + "/" + data['products'][i].image;
                                        var str_info = data['products'][i].discount > 0 ? "<div class='div-row'>" +
                                        "<span class='sale-label'>SALE</span>" +
                                        "<span class='price-new pull-right'>"+ accounting.formatNumber(data['products'][i].price - data['products'][i].price*data['products'][i].discount/100, 0, ',', '.') +" đ</span>" +
                                        "</div>" +
                                        "<div class='div-row'>" +
                                        "<span class='p-name pull-left'>"+ data['products'][i].pro_name +"</span>" +
                                        "<span class='price-old pull-right'>"+ accounting.formatNumber(data['products'][i].price, 0, ',', '.') +" đ</span></div>" : "<div class='div-row'>" +
                                        "<span class='p-name'>"+ data['products'][i].pro_name +"</span>" +
                                        "<span class='price-new pull-right'>"+ accounting.formatNumber(data['products'][i].price, 0, ',', '.') +" đ</span></div>";

                                        $('#list_products').append("<div class='col-md-3 col-xs-6 product'>" +
                                            "<div class='p-img'>" +
                                            "<a href='"+ url_product +"'>" +
                                            "<img src='"+ url_img +"'/></a>" +
                                            "<a href='#' class='icon-cart'><i class='fa fa-shopping-bag fa-1-2'></i></a>" +
                                            "</div>" +
                                            "<div class='p-title'>"+ str_info +"</div></div>");
                                    }
                                }
                                $('#loading').hide();
                            }, 1000);
                        }

                    }
                });

                return false;
            }
        });
    });
</script>
@stop