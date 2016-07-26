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
        @foreach($img_colors as $img)
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
                <p class="title">{{$product->pro_name}}<span>{{number_format($product->price, 0, ',', '.')}}đ</span></p>
                <p>Chất liệu: cotton<br/>Đánh giá: 4.5</p>
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
                                    $url_img = asset('upload/images/'.$color->color);
                            ?>
                                    <input type="radio" name="color_id" value="{{$color->color_id}}" id="{{'ms-check'.$stt}}"/>
                                    <label for="{{'ms-check'.$stt}}" style="background-image: url('<?php echo $url_img ?>')"></label>

                            <?php } ?>
                        </div>
                    </div>

                    <div>
                        <p class="title">Kích cỡ</p>
                        <div class="kichco">
                            <?php
                            $stt = 0;
                            foreach($sizes as $size){
                                $stt++;
                                ?>
                                <input type="radio" name="size_id" value="{{$size->size_id}}" id="{{'kc-check'.$stt}}"/>
                                <label for="{{'kc-check'.$stt}}">{{$size->size}}</label>

                            <?php } ?>
                        </div>
                    </div>

                    <div>
                        <p class="title">Số lượng: <input type="number" name="quantity" value="1"/></p>
                        <input id="btn_add" type="button" name="btnSubmit" value="THÊM VÀO GIỎ"/>
                    </div>
                </div>
            </form>

            <div class="div-1" style="text-align: justify">
                {{$product->short_des}}
            </div>

            <div>
                <div id="fb-root"></div>
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id)) return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));
                </script>
            </div>
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
@stop

@section('javascript')
<script>
    $('#btn_add').click(function(){
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
                    $('#cart_num').html(data.length);
                    $('#cart_num').show();
                    $('#shopping_cart').html('');
                    var price;
                    var total_money = 0;
                    for(var i=0; i < data.length; i++){
                        var url = "{{asset('upload/images')}}" + "/" + data[i].image;
                        var quantity = data[i].quantity;
                        price = data[i].price - data[i].price * data[i].discount / 100;
                        total_money += price * data[i].quantity;
                        price = accounting.formatNumber(price, 0, ".", ",");
                        $('#shopping_cart').append("<tr>" +
                            "<td width='20%'><img src='"+ url +"' style='width: 100%;height: auto'/></td>" +
                            "<td>"+ data[i].pro_name +"<br>" +
                            "<input type='number' class='quan_num' name='cart_quantity' value='"+ data[i].quantity +"' /> " +
                            "x "+ price +"đ</td>" +
                            "<td>Size <label class='box-size'>"+ data[i].size +"</label></td>" +
                            "<td><i class='fa fa-times-circle' </td>" +
                            "</tr>");
                    }
                    total_money = accounting.formatNumber(total_money, 0, ".", ",");
                    $('#cart_total').html(total_money);
                    $('#cart').addClass('open');
                }
            }
        });
    });
</script>
@stop