@extends('layout')
@section('title')
Stylitics - Product page
@stop

@section('content')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Giỏ hàng
</nav>

<div class="container detail-p">
    <div class="col-md-9 col-sm-9">
        <form method="post" action="" class="form-horizontal">
            <p class="title">GIỎ HÀNG</p>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Sản phẩm</th>
                    <th width="150px">Giá</th>
                    <th width="100px">Số lượng</th>
                    <th width="150px">Thành tiền</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>1</td>
                    <td>MIDNIGHT LOVER DRESS</td>
                    <td>200.000đ</td>
                    <td><input type="number" value="2"/></td>
                    <td>400.000đ</td>
                    <td><a class="fa fa-times-circle"></a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>MIDNIGHT LOVER DRESS</td>
                    <td>200.000đ</td>
                    <td><input type="number" value="2"/></td>
                    <td>400.000đ</td>
                    <td><a class="fa fa-times-circle"></a></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>Tổng tiền</td>
                    <td>800.000đ</td>
                    <td></td>
                </tr>
                </tbody>
            </table>
            <p style="border-top: 1px solid #ccc;"></p>
            <p class="title">THANH TOÁN ĐƠN HÀNG</p>
            <div class="form-group" style="margin-top: 20px">
                <div class="col-md-2">
                    <label for="name" class="control-label">Họ tên</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Họ tên người nhận">
                </div>
                <div class="col-md-2">
                    <label for="phone" class="control-label pull-right">Số điện thoại</label>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="SĐT người nhận">
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2">
                    <label for="name" class="control-label">Tỉnh/Thành phố</label>
                </div>
                <div class="col-md-5">
                    <select class="form-control" id="sel1">
                        <option>Tỉnh/Thành phố</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>

            </div>
            <div class="form-group">
                <div class="col-md-2">
                    <label for="name" class="control-label">Quận/Huyện</label>
                </div>
                <div class="col-md-5">
                    <select class="form-control" id="sel1">
                        <option>Quận/Huyện</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2">
                    <label for="name" class="control-label">Địa chỉ</label>
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Địa chỉ nhận hàng">
                </div>
                <div class="col-md-5">
                    <input type="submit" class="pull-right" value="ĐẶT HÀNG">
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-3 col-sm-3">
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