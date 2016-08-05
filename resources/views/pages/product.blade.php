@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('content')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    {{$product->pro_name}}
</nav>
<div class="container detail-p">
    <div class="col-xs-12 col-sm-2 col-md-1 list">
        @foreach($img_prods as $img)
        <img src="{{asset('upload/images/'.$img->images)}}"/>
        @endforeach
    </div>

    <div class="col-xs-12 col-sm-5 col-md-3 detail">
        <div class="large"></div>
        <img class="small" src="{{asset('upload/images/'.$product->image)}}"/>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-5 info">
        <div>
            <div class="div-1">
                <p class="title">{{$product->pro_name}}<span class="price-new">{{number_format($product->price - $product->price*$product->discount/100, 0, ',', '.')}}đ</span>
                    <span class="price-old" style="margin-right: 10px">{{number_format($product->price, 0, ',', '.')}}đ</span></p>
<!--                <p>Chất liệu: cotton<br/>Đánh giá: 4.5</p>-->
            </div>

            <form id="cart_form" method="post" action="">
                <input type="hidden" name="product_id" value="{{$product->id}}" />
                <div class="div-2">
                    <div>
                        <p class="title">Màu sắc</p>
                        <div class="mausac">
                            <?php
                                $stt = 0;
                                foreach($img_colors as $color){
                                    $stt++;
                                    $url_img = asset('upload/images/colors/'.$color->color);
                            ?>
                                    <input type="radio" name="color_id" class="chk_color" url_prod_img="{{asset('upload/images/'.$color->images)}}"
                                           value="{{$color->color_id}}" id="{{'ms-check'.$stt}}"/>
                                    <label for="{{'ms-check'.$stt}}" style="background-image: url('<?php echo $url_img ?>')"></label>

                            <?php } ?>
                        </div>
                    </div>

                    <div>
                        <p class="title">Kích cỡ</p>
                        <div class="kichco">
                            <div class="form-group" style="width: 160px">
                                <select class="form-control" id="size_id"  name="size_id">
                                    <option value="">Vui lòng chọn size</option>
                                    @foreach($sizes as $size)
                                    <option value="{{$size->size_id}}">{{$size->size}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>

                    <div>
                        <p class="title">Số lượng: <input type="number" name="quantity" onkeyup="num_cart_validate(this);" min='1' max='20' value="1"/></p>
                        <input id="btn_add" type="button" name="btnSubmit" value="THÊM VÀO GIỎ"/>
                    </div>
                </div>
            </form>

<!--            <div class="div-1" style="text-align: justify">-->
<!--                {!! $product->full_des !!}-->
<!--            </div>-->

        </div>
    </div>
    <div class="col-sm-3 col-md-3">
        <ul class="box-info">
            <li style="padding-top: 15px">
                <i class="fa fa-truck" style="font-size: 40px; width:25%; float: left; text-align: center"></i>
                <span style="font-size: 18px; font-weight: bold">Miễn phí vận chuyển</span>
                <br>
                <span class="small">với hóa đơn trên 500.000đ</span>
            </li>
            <li>
                <span class="fa fa-map-marker" style="font-size: 40px; width:25%; text-align: center"></span>
                <span style="font-size: 18px; font-weight: bold; position:relative; bottom:10px; left:-3px">Giao hàng toàn quốc</span>
            </li>
            <li>
                <span class="fa fa-refresh" style="font-size: 40px; width:25%; text-align: center"></span>
                <span style="font-size: 18px; font-weight: bold; position:relative; bottom:10px; left:-3px">Đổi trả trong 3 ngày</span>
            </li>
        </ul>
        <ul class="box-info box-info-border" style="margin-top: 30px">
            <li style="font-weight: bold">Tel: 04.7303.0222(#102)</li>
            <li style="font-weight: bold">Hotline: 0934593585</li>
            <li style="font-weight: bold">E-mail: saleonline@stylitics.vn</li>
            <li>Thứ 2 - thứ 6 : 9AM - 22PM</li>
        </ul>
    </div>
</div>

<div class="container info-tabs">
    <div class="col-md-9 col-sm-9">
        <ul class="nav nav-tabs">
            <li role="presentation" class="active">
                <a href="#description" data-toggle="tab">Thông tin sản phẩm</a>
            </li>
            <li role="presentation">
                <a href="#comment" data-toggle="tab">Bình luận</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="description">{!! $product->full_des !!}</div>
            <div class="tab-pane" id="comment">
                <div class="fb-comments" data-href="http://localhost:7070/public/product/{{$product->id}}" data-width="100%" data-numposts="5"></div>
            </div>
        </div>
    </div>

</div>

@if($products->count() > 0)
    <div class="list-products list-p-slide">
        <div class="heading" style="padding-top: 0"><span>SẢN PHẨM TƯƠNG TỰ</span></div>
        <div id="p-slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for($i = 0; $i < sizeof($products)/4; $i++)
                <li data-target="#p-slider" data-slide-to="{{$i}}" class="{{$i==0 ? 'active' : ''}}"></li>
                @endfor
            </ol>

            <div class='carousel-inner' role="listbox">
                @for($j = 0; $j < sizeof($products)/4; $j++)
                <div class="item{{$j==0 ? ' active' : ''}}">
                    @for($i = $j*4; $i < $j*4 + 4; $i++)
                    <div class="col-sm-3 col-md-3 product">
                        <div class="p-img">
                            <a href="{{asset('product/'.$products[$i]->id)}}"><img src="{{asset('upload/images/'.$products[$i]->image)}}"/></a>
                            <a href="#" class="icon-cart"><i class="fa fa-search fa-1-2"></i></a>
                        </div>
                        <div class="p-title">
                            @if($products[$i]->discount > 0)
                            <div class="div-row">
                                <span class="sale-label">SALE</span>
                                <span class="price-new pull-right">{{number_format($products[$i]->price - $products[$i]->price*$products[$i]->discount/100, 0, ',', '.')}} đ</span>
                            </div>
                            <div class="div-row">
                                <span class="p-name pull-left">{{$products[$i]->pro_name}}</span>
                                <span class="price-old pull-right">{{number_format($products[$i]->price, 0, ',', '.')}} đ</span>
                            </div>
                            @else
                            <div class="div-row">
                                <span class="p-name">{{$products[$i]->pro_name}}</span>
                                <span class="price-new pull-right">{{number_format($products[$i]->price, 0, ',', '.')}} đ</span>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endfor
                </div>
                @endfor
            </div>

            <!--                <a class="left carousel-control" href="#p-slider" role="button" data-slide="prev">-->
            <!--                    <span class="fa fa-angle-left" aria-hidden="true"></span>-->
            <!--                    <span class="sr-only">Previous</span>-->
            <!--                </a>-->
            <!--                <a class="right carousel-control" href="#p-slider" role="button" data-slide="next">-->
            <!--                    <span class="fa fa-angle-right" aria-hidden="true"></span>-->
            <!--                    <span class="sr-only">Next</span>-->
            <!--                </a>-->
        </div>
    </div>
@endif
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.7&appId=194334174266198";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
@stop

@section('javascript')
<script>
    $('#btn_add').click(function(){
        if(!$('.chk_color').is(':checked') && $('#size_id').val() == ''){
            alert('Vui lòng chọn màu sắc và kích cỡ!');
            return true;
        }
        else if(!$('.chk_color').is(':checked')){
            alert('Vui lòng chọn màu sắc!');
            return true;
        }
        else if($('#size_id').val() == ''){
            alert('Vui lòng chọn kích cỡ!');
            return true;
        }

        var data = $('#cart_form').serialize();
        $.ajax({
            type: 'POST',
            url: "{{asset('cart/add')}}",
            data: data,
            cache: false,
            success: function (data) {
                if(data == 'false'){
                    alert('Có lỗi xảy ra. Vui lòng thử lại sau!');
                }
                else{
                    $('#shopping_cart').html('');
                    var price;
                    var price_int;
                    var total_money = 0;
                    var count_item = 0;
                    $.each(data, function( rowid, cart ) {
                        var url = "{{asset('upload/images')}}" + "/" + cart.options.image;
                        var quantity = cart.qty;
                        price_int = cart.price - cart.discount;
                        total_money += cart.subtotal;
                        price = accounting.formatNumber(price_int, 0, ".", ",");
                        count_item += parseInt(cart.qty);
                        $('#shopping_cart').append("<tr class='cart_id"+ cart.rowid +"'>" +
                            "<td><a class='btn_del' onclick='cart_del(this);' id='"+ cart.rowid +"'" +
                            "p-name='"+ cart.name +"' money='"+ cart.subtotal +"'>" +
                            "<i class='fa fa-times-circle'></i></a></td>" +
                            "<td width='20%'><img src='"+ url +"' style='width: 100%;height: auto'/></td>" +
                            "<td>"+ cart.name +"<br>" +
                            "<input type='number' class='qty_num qty_num"+cart.rowid+"' id='"+cart.rowid+"' " +
                            "price='"+price_int+"' onkeyup='num_cart_validate(this);' " +
                            "onchange='qty_onchange(this);' min='1' max='20' value='"+cart.qty+"' />" +
                            " x "+ price +"đ</td>" +
                            "<td>Size <label class='box-size'>"+ cart.options.size +"</label></td>" +
                            "</tr>");
                    });
                    $('#cart_num').html(count_item);
                    $('#cart_num').show();
                    $('#total_money').val(total_money);
                    total_money = accounting.formatNumber(total_money, 0, ".", ",");
                    $('.cart_total').html(total_money);
                    $('#cart').addClass('open');
                }
            }
        });
    });
</script>
@stop