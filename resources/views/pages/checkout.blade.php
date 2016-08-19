@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('breadcrumb')
<nav class="breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Đặt hàng
</nav>
@stop

@section('content')
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
                {{ csrf_field() }}
                <div class="border col-md-5">
                    <div class="checkout_title">
                        <div><span class="badge">1</span>Địa chỉ giao hàng</div>
                    </div>
                    @if (count($errors) > 0)
                    <div id="checkout_alert" class="alert alert-danger">
                        <ul style="list-style-type: inherit">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div id="checkout_alert_adr" class="alert alert-danger">
                        <p>Error: </p>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên</label>
                        @if(!Auth::check())
                        <input type="text" name="name" id="name" class="form-control"/>
                        @else
                        <input type="text" name="name" id="name" value="{{$customer->name}}" class="form-control" readonly />
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        @if(!Auth::check())
                        <input type="text" name="phone" id="phone" class="form-control" />
                        @else
                        <input type="text" name="phone" id="phone" value="{{$customer->phone}}" class="form-control" readonly />
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        @if(!Auth::check())
                        <input type="email" name="email" id="email" class="form-control" />
                        @else
                        <input type="email" name="email" id="email" value="{{$customer->email}}" class="form-control" readonly />
                        @endif
                    </div>
                    <div class="form-group" style="width: 47%; float: left">
                        <label for="city">Tỉnh/Thành phố</label>
                        <select class="form-control" id="province" name="province" onchange="province_onchange(this);">
                            <option value="">Tỉnh/Thành phố</option>
                            @foreach($provinces as $province)
                            <option value="{{$province->id}}">{{mb_convert_case($province->name, MB_CASE_TITLE, "UTF-8")}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group"style="width: 48%; float: right">
                        <label for="district">Quận/Huyện</label>
                        <select class="form-control" id="district" name="district">
                            <option value="">Quận/Huyện</option>
                            @if(isset($districts))
                            @foreach($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="adr">Địa chỉ</label>
                        @if(!Auth::check())
                        <input type="text" name="address" id="address" class="form-control">
                        @else
                        <input type="text" name="address" id="address" value="{{$customer->address}}" class="form-control">
                        @endif
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
                        $price = $cart->price - $cart->discount;
                        $total_money += $cart->subtotal;
                        ?>
                        <tr class="cart_id{{$cart->rowid}}" money="{{$cart->subtotal}}">
                            <td><a class="btn_del" onclick="cart_del(this);" id="{{$cart->rowid}}" p-name="{{$cart->name}}">
                                    <i class="fa fa-times-circle"></i></a></td>
                            <td width="90px"><img src="{{asset('upload/images/'.$cart->options->image)}}" style="width: 75px" /></td>
                            <td>{{$cart->name}}</td>
                            <td style="text-align: center"><label class="box-color" style="background-color: <?php echo $cart->options->color ?>"></label></td>
                            <td><label class="box-size">{{$cart->options->size}}</label></td>
                            <td>{{number_format($price, 0, ',', '.')}} đ</td>
                            <td><input type="number" id="{{$cart->rowid}}" class="qty_num qty_num{{$cart->rowid}}" price="{{$price}}"
                                       onkeyup="num_cart_validate(this);"
                                       onchange="qty_onchange(this);" min="1" max="20" value="{{$cart->qty}}" /></td>
                            <td>{{number_format($cart->subtotal, 0, ',', '.')}} đ</td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6"></td>
                            <td><strong>Tổng tiền</strong></td>
                            <td><strong><label class="cart_total">{{number_format($total_money, 0, ',', '.')}}</label> đ</strong></td>
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
<script>
    $(document).ready(function(){
        $('#province').val("{{Auth::check() ? $customer->province_id : ''}}");
        $('#district').val("{{Auth::check() ? $customer->district_id : ''}}");

        $('#checkout_form').validate({
            rules: {
                name: 'required',
                phone: {
                    required: true,
                    phoneno: true,
                    minlength: 10,
                    maxlength: 11
//                    remote: {
//                        url: "{{asset('checkexist/phone')}}",
//                        type: 'POST'
//                    }
                },
                email: {
                    required: true,
                    email: true
//                    remote: {
//                        url: "{{asset('checkexist/email')}}",
//                        type: 'POST'
//                    }
                },
                province: 'required',
                district: 'required',
                address: 'required'
            },
            messages:{
                name: "Vui lòng nhập họ tên",
                phone: {
                    required: "Vui lòng nhập số điện thoại",
                    remote: "Số điện thoại đã tồn tại"
                },
                email: {
                    required: "Vui lòng nhập E-mail",
                    email: "Vui lòng nhập đúng định dạng E-mail",
                    remote: "Địa chỉ E-mail đã tồn tại"
                },
                province: 'Vui lòng chọn tỉnh thành',
                district: 'Vui lòng chọn quận huyện',
                address: 'Vui lòng nhập địa chỉ'
            }
        });
    });

</script>
@stop