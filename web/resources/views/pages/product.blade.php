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
        <img src="{{asset('../resources/assets/image/sanpham.jpg')}}"/>
        <img src="{{asset('../resources/assets/image/sanpham1.jpg')}}"/>
        <img src="{{asset('../resources/assets/image/sanpham2.jpg')}}"/>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-4 detail">
        <div class="large"></div>
        <img class="small" src="{{asset('../resources/assets/image/sanpham.jpg')}}"/>
    </div>

    <div class="col-xs-12 col-sm-5 col-md-7 info">
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
                        <p>Vui lòng chọn màu sắc ở trên</p>
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
                <p class="title">Tel: 04.7303.0222(#102)<br/>Hotline: 0934593585</p>
                <p>Thứ 2 - thứ 6 : 9AM - 5 PM | Email : saleonline@stylitics.vn</p>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')

@stop