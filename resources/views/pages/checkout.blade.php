@extends('layouts.master')
@section('title')
Stylitics - Product page
@stop

@section('content')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Thanh toán
</nav>

<div class="container checkoutpage" style="padding: 0 45px">
    <div class="row">
        <div class="col-md-0.3"></div>
        <div class="col-md-11.7">
            <p class="bg-warning">Bạn đã có tài khoản. Bấm vào <a href="#" id="btn-login" data-toggle="modal" data-target="#login_modal" style="text-decoration: underline">đây</a> để đăng nhập.</p>
        </div>
        <div class="checkout_content">
            <form id="checkout_form" role="form">
                <div class="col-md-4">
                    <div class="checkout_title">
                        <div><span class="badge">1</span>Địa chỉ giao hàng</div>
                    </div>
                    <div id="checkout_alert_adr" class="alert alert-danger">
                        <p>Error: </p>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên:</label>
                        <input type="text" id="name" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="adr">Địa chỉ</label>
                        <input type="text" id="adr" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="city">Thành phố</label>
                        <input type="text" id="city" class="form-control">
                    </div>
                </div>
                <div class="border col-md-4">
                    <div class="checkout_title">
                        <div><span class="badge">2</span>Phương thức giao hàng</div>
                    </div>
                    <div class="form-group">
                        <label for="ship">Chi phí giao hàng</label><br/>
                        <input type="radio" name="ship" checked="checked" value="20.000 VNĐ" /> 20.000 VNĐ
                    </div>
                    <div class="checkout_title">
                        <div><span class="badge">3</span>Phương thức thanh toán</div>
                    </div>
                    <div id="checkout_alert_paym" class="alert alert-danger">
                        <p>Error: </p>
                        <span></span>
                    </div>
                    <div class="form-group">
                        <div class="radio">
                            <label><input type="radio" name="payment">Thanh toán bằng chuyển khoản</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="payment">Thanh toán khi nhận hàng</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="checkout_title">
                        <div><span class="badge">4</span>Thông tin đơn hàng</div>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="col-md-7">Tên sản phẩm</td>
                            <td class="col-md-3">3</td>
                            <td class="col-md-2">600.000 VNĐ</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Tổng giá</td>
                            <td>600.000VNĐ</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Phí vận chuyển</td>
                            <td>20.000 VNĐ</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><strong>Tổng đơn hàng</strong></td>
                            <td><strong>620.000 VNĐ</strong></td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="col-md-7"></div>
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-warning">Đặt hàng</button>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@section('javascript')

@stop