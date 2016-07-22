@extends('layout')
@section('title')
Stylitics - Product page
@stop

@section('content')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    MIDNIGHT LOVER DRESS
</nav>
<div class="container detail-p">
    <div class="col-xs-12 col-sm-2 col-md-1 list">
        <img src="{{asset('assets/image/sanpham.jpg')}}"/>
        <img src="{{asset('assets/image/sanpham1.jpg')}}"/>
        <img src="{{asset('assets/image/sanpham2.jpg')}}"/>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-3 detail">
        <div class="large"></div>
        <img class="small" src="{{asset('assets/image/sanpham.jpg')}}"/>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-5 info">
        <div>
            <div class="div-1">
                <p class="title">MIDNIGHT LOVER DRESS<span>200.000đ</span></p>
                <p>Chất liệu: cotton<br/>Đánh giá: 4.5</p>
            </div>

            <form>
                <div class="div-2">
                    <div>
                        <p class="title">Màu sắc</p>
                        <div class="mausac">
                            <input type="radio" name="mausac" id="ms-check1" value="black"/>
                            <input type="radio" name="mausac" id="ms-check2" value="pink"/>
                            <input type="radio" name="mausac" id="ms-check3" value="red"/>
                        </div>
                    </div>

                    <div>
                        <p class="title">Kích cỡ</p>
                        <div class="kichco">
                            <input type="radio" name="kichco" id="kc-check1"/>
                            <label for="kc-check1">S</label>
                            <input type="radio" name="kichco" id="kc-check2"/>
                            <label for="kc-check2">M</label>
                            <input type="radio" name="kichco" id="kc-check3"/>
                            <label for="kc-check3">N</label>
                        </div>
                    </div>

                    <div>
                        <p class="title">Số lượng: <input type="number" value="1"/></p>
                        <input type="submit" name="btnSubmit" value="THÊM VÀO GIỎ"/>
                    </div>
                </div>
            </form>

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

@stop