@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('content')
<nav class="breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    {{$product->pro_name}}
</nav>
<div class="container detail-p">
    <div class="col-xs-12 col-sm-2 col-md-1 list">
        @foreach($img_prods as $img)
        <img src="{{asset('upload/images/details/'.$img->images)}}"/>
        @endforeach
    </div>

    <div class="col-xs-12 col-sm-5 col-md-3 magnify">
        <div class="large"></div>
        <img class="small" src="{{asset('upload/images/'.$product->image)}}" width="100%"/>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-5 info">
        <div>
            <div class="div-1">
                <p class="title">{{$product->pro_name}}<span class="price-new">{{number_format($product->price - $product->price*$product->discount/100, 0, ',', '.')}}đ</span>
                    <span class="price-old" style="margin-right: 10px">{{number_format($product->price, 0, ',', '.')}}đ</span></p>
                <h6>Mã SP: {{$product->pro_code}}</h6>
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
                                    $c = $color->color;
                            ?>
                                    <input type="radio" name="color_id" class="chk_color"
                                           value="{{$color->color_id}}" id="{{'ms-check'.$stt}}"/>
                                    <label for="{{'ms-check'.$stt}}" style="<?php echo 'background-color:'.$color->color ?>"></label>

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
                        <input id="btn_add" onclick="normalAddCart();" type="button" name="btnSubmit" value="THÊM VÀO GIỎ"/>
                    </div>
                </div>
            </form>

<!--            <div class="div-1" style="text-align: justify">-->
<!--                {!! $product->full_des !!}-->
<!--            </div>-->
            <div class="fb-like" data-href="http://localhost:7070/public/product/{{$product->id}}" data-layout="standard"
                 data-action="like" data-size="small" data-send="true" data-show-faces="true" data-share="true"></div>

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
<script type="text/javascript">
    $(document).ready(function(){

        var native_width = 0;
        var native_height = 0;

        //Now the mousemove function
        $(".magnify").mousemove(function(e){
            //When the user hovers on the image, the script will first calculate
            //the native dimensions if they don't exist. Only after the native dimensions
            //are available, the script will show the zoomed version.
            if(!native_width && !native_height)
            {
                //This will create a new image object with the same image as that in .small
                //We cannot directly get the dimensions from .small because of the
                //width specified to 200px in the html. To get the actual dimensions we have
                //created this image object.
                var image_object = new Image();
                image_object.src = $(".small").attr("src");

                //This code is wrapped in the .load function which is important.
                //width and height of the object would return 0 if accessed before
                //the image gets loaded.
                native_width = image_object.width;
                native_height = image_object.height;
            }
            else
            {
                //x/y coordinates of the mouse
                //This is the position of .magnify with respect to the document.
                var magnify_offset = $(this).offset();
                //We will deduct the positions of .magnify from the mouse positions with
                //respect to the document to get the mouse positions with respect to the
                //container(.magnify)
                var mx = e.pageX - magnify_offset.left;
                var my = e.pageY - magnify_offset.top;

                //Finally the code to fade out the glass if the mouse is outside the container
                if(mx < $(this).width() && my < $(this).height() && mx > 0 && my > 0)
                {
                    $(".large").fadeIn(100);
                }
                else
                {
                    $(".large").fadeOut(100);
                }
                if($(".large").is(":visible"))
                {
                    //The background position of .large will be changed according to the position
                    //of the mouse over the .small image. So we will get the ratio of the pixel
                    //under the mouse pointer with respect to the image and use that to position the
                    //large image inside the magnifying glass
                    var rx = Math.round(mx/$(".small").width()*native_width - $(".large").width()/2)*-1;
                    var ry = Math.round(my/$(".small").height()*native_height - $(".large").height()/2)*-1;
                    var bgp = rx + "px " + ry + "px";

                    //Time to move the magnifying glass with the mouse
                    var px = mx - $(".large").width()/2;
                    var py = my - $(".large").height()/2;
                    //Now the glass moves with the mouse
                    //The logic is to deduct half of the glass's width and height from the
                    //mouse coordinates to place it with its center at the mouse coordinates

                    //If you hover on the image now, you should see the magnifying glass in action
                    $(".large").css({left: px, top: py, backgroundPosition: bgp});
                }
            }
        })
    });


</script>
@stop