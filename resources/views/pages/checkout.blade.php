@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('content')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Đặt hàng
</nav>

<div class="container checkoutpage" style="padding: 0 45px">
    <div class="row">
<!--        <div class="col-md-0.3"></div>-->
<!--        <div class="col-md-11.7">-->
<!--            <p class="bg-warning">Bạn đã có tài khoản. Bấm vào <a href="#" id="btn-login" data-toggle="modal" data-target="#login_modal" style="text-decoration: underline">đây</a> để đăng nhập.</p>-->
<!--        </div>-->
        @if (session('message'))
        <div id="myAlert" class="alert {{session('alert-class')}} alert-dismissable fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <i class="icon fa {{session('fa-class')}}"></i>
            {{ session('message') }}
        </div>
        <p><a class="txt-link" href="{{asset('')}}">Click vào đây</a> để tiếp tục mua hàng.</p>
        @endif

        @if(!$carts->count() > 0 && !session('message'))
            <h3>Giỏ hàng trống</h3>
            <p>Bạn chưa có sản phẩm nào trong giỏ hàng.</p>
            <p><a class="txt-link" href="{{asset('')}}">Click vào đây</a> để tiếp tục mua hàng.</p>
        @elseif($carts->count() > 0)
        <div class="checkout_content">
            <form id="checkout_form" role="form" method="post" action="{{asset('checkout')}}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="border col-md-5">
                    <div class="checkout_title">
                        <div><span class="badge">1</span>Địa chỉ giao hàng</div>
                    </div>
                    <div id="checkout_alert_adr" class="alert alert-danger">
                        <p>Error: </p>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        <input type="text" name="name" id="name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
<!--                    <div class="form-group" style="width: 47%; float: left">-->
<!--                        <label for="city">Tỉnh/Thành phố</label>-->
<!--                        <select class="form-control" id="city">-->
<!--                            <option>Tỉnh/Thành phố</option>-->
<!--                            <option>2</option>-->
<!--                            <option>3</option>-->
<!--                            <option>4</option>-->
<!--                        </select>-->
<!--                    </div>-->
<!--                    <div class="form-group"style="width: 48%; float: right">-->
<!--                        <label for="district">Quận/Huyện</label>-->
<!--                        <select class="form-control" id="district">-->
<!--                            <option>Quận/Huyện</option>-->
<!--                            <option>2</option>-->
<!--                            <option>3</option>-->
<!--                            <option>4</option>-->
<!--                        </select>-->
<!--                    </div>-->
                    <div class="form-group">
                        <label for="adr">Địa chỉ</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>

                </div>
<!--                <div class="border col-md-4">-->
<!--                    <div class="checkout_title">-->
<!--                        <div><span class="badge">2</span>Phương thức giao hàng</div>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <label for="ship">Chi phí giao hàng</label><br/>-->
<!--                        <input type="radio" name="ship" checked="checked" value="20.000 VNĐ" /> 20.000 VNĐ-->
<!--                    </div>-->
<!--                    <div class="checkout_title">-->
<!--                        <div><span class="badge">3</span>Phương thức thanh toán</div>-->
<!--                    </div>-->
<!--                    <div id="checkout_alert_paym" class="alert alert-danger">-->
<!--                        <p>Error: </p>-->
<!--                        <span></span>-->
<!--                    </div>-->
<!--                    <div class="form-group">-->
<!--                        <div class="radio">-->
<!--                            <label><input type="radio" name="payment">Thanh toán bằng chuyển khoản</label>-->
<!--                        </div>-->
<!--                        <div class="radio">-->
<!--                            <label><input type="radio" name="payment">Thanh toán khi nhận hàng</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="col-md-7">
                    <div class="checkout_title">
                        <div><span class="badge">2</span>Thông tin đơn hàng</div>
                    </div>
                    <table id="order_table" class="table">
                        <thead>
                        <tr>
                            <th width="10px"></th>
                            <th colspan="2">Sản phẩm</th>
                            <th width="65px">Màu sắc</th>
                            <th width="60px">Size</th>
                            <th width="85px">Giá</th>
                            <th width="80px">Số lượng</th>
                            <th width="110px">Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total_money = 0;
                        foreach($carts as $cart){
                        $price = $cart->price - $cart->price * $cart->discount / 100;
                        $total_money += $price * $cart->quantity;
                        ?>
                        <tr>
                            <td><i class="fa fa-times-circle"></i></td>
                            <td width="90px"><img src="{{asset('upload/images/'.$cart->image)}}" style="width: 75px" /></td>
                            <td>{{$cart->pro_name}}</td>
                            <td style="text-align: center"><label class="box-color"><img src="{{asset('upload/images/'.$cart->color)}}" /></label></td>
                            <td><label class="box-size">{{$cart->size}}</label></td>
                            <td>{{number_format($price, 0, ',', '.')}} đ</td>
                            <td><input type="number" class="quan_num" name="qty_{{$cart->product_id}}" value="{{$cart->quantity}}" /></td>
                            <td>{{$price * $cart->quantity}} đ</td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6"></td>
                            <td><strong>Tổng tiền</strong></td>
                            <td><strong>{{$total_money}} đ</strong></td>
                        </tr>
                        </tbody>
                    </table>

                    <input type="submit" class="pull-right" style="margin-top: 40px;" value="ĐẶT HÀNG" />
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
@stop

@section('javascript')

@stop