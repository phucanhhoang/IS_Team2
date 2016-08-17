@extends('layouts.master')
@section('title')
Stylitics - User page
@stop

@section('breadcrumb')
<nav class="container breadcrumbs">
    <a href="{{asset('/')}}">Trang chủ</a>
    <span class="divider">›</span>
    Hồ sơ cá nhân
</nav>
@stop

@section('content')
<div class="container">
    <div class="col-sm-3 col-md-3 user">
        <ul>
            <a href="{{asset('user/info')}}"><li><i class="fa fa-user"></i>THÔNG TIN CƠ BẢN</li></a>
            <a href="{{asset('user/secure')}}"><li><i class="fa fa-lock"></i>BẢO MẬT VÀ MẬT KHẨU</li></a>
            <a href="{{asset('user/order')}}"><li class="state-focus"><i class="fa fa-calendar"></i>LỊCH SỬ ĐƠN HÀNG</li></a>
        </ul>
    </div>
    <div class="col-sm-9 col-md-9">
        <div class="heading-2">
            <span class="title-arrow">
                <span class="title-text">LỊCH SỬ ĐƠN HÀNG</span>
            </span>
        </div>
        <form id="search_form" class="form-inline" role="form">
            <div class="form-group">
                <label for="xemtu">Xem từ</label>
                <?php
                $date = new DateTime('-1 months');
                ?>
                <input type="text" class="form-control datepicker" id="xemtu" name="xemtu" value="{{$date->format('d/m/Y')}}" placeholder="dd/mm/yyyy">
            </div>
            <div class="form-group">
                <label for="xemden">Xem đến</label>
                <input type="text" class="form-control datepicker" id="xemden" name="xemden" value="{{date('d/m/Y')}}" placeholder="dd/mm/yyyy">
            </div>
            <div class="form-group">
                <label for="status">Loại giao dịch</label>
                <select class="form-control" id="status" name="status" onchange="">
                    <option value="">Tất cả giao dịch</option>
                    <option value="{{App\Enum\OrderStatus::PENDING}}">Chờ xác nhận</option>
                    <option value="{{App\Enum\OrderStatus::PROCESSING}}">Đang xử lý</option>
                    <option value="{{App\Enum\OrderStatus::COMPLETE}}">Giao hàng thành công</option>
                    <option value="{{App\Enum\OrderStatus::CANCELED}}">Hủy</option>
                </select>
            </div>
            <input type="button" id="btn_search" style="position: relative;top: 2px;margin-left: 10px;" value="TÌM KIẾM" />
        </form>

    @if(isset($orders))
    <table id="order_table" class="table table-bordered table-hover" style="width:100%;font-size: 16px;margin-top: 20px">
        <thead>
            <tr>
                <th>Ngày đặt hàng</th>
                <th>Mã HĐ</th>
                <th>Tổng tiền</th>
                <th>Trạng thái</th>
                <th>Địa chỉ nhận hàng</th>
                <th>Chi tiết</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td style="text-align: center">{{date_format($order->created_at, 'd/m/Y')}}</td>
                <td style="text-align: center">{{$order->id}}</td>
                <td style="text-align: center">{{number_format($order->total_money, '0', ',', '.')}} đ</td>
                <td>{{$order->status == App\Enum\OrderStatus::PENDING ? 'Chờ xác nhận'
                    : ($order->status == App\Enum\OrderStatus::PROCESSING ? 'Đang xử lý'
                    : ($order->status == App\Enum\OrderStatus::COMPLETE ? 'Giao hàng thành công'
                    : 'Hủy'))}}</td>
                <td>{{$order->address}}</td>
                <td style="text-align: center">
                    <a href="#" id="{{$order->id}}" class="btn-view" onclick='viewOrderDetail(this);' data-toggle="modal" data-target="#order_detail_modal"><i class="fa fa-file-text"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h4>Bạn chưa có đơn hàng nào.</h4>
    @endif
    </div>
</div>

<div class="modal fade in" id="order_detail_modal" role="dialog" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 800px">
        <div id="login" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Chi tiết đơn hàng</h4>
            </div>
            <div class="modal-body">
                <table id="order_detail_table" class="table table-bordered" style="width:100%;font-size:14px">
                    <thead>
                        <tr>
                            <th>Mã HĐ</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Màu sắc</th>
                            <th>Size</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
<script>
$(function(){
    $( ".datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy'
    });
});

$('#btn_search').click(function(){
    var data = $('#search_form').serialize();
    $.ajax({
        type: 'POST',
        url: "{{asset('user/order/search')}}",
        data: data,
        cache: false,
        success: function(data){
            $('#order_table > tbody').html('');
            $.each(data, function(key, val){
                var date = new Date(val.created_at);
                var status = val.status == 0 ? 'Chờ xác nhận' : (val.status == 1 ? 'Đang xử lý' :
                    (val.status == 2 ? 'Giao hàng thành công' : 'Hủy'));
                $('#order_table > tbody').append("<tr>" +
                    "<td style='text-align:center'>"+ date.getDate() +'/'+ (date.getMonth()+1) +'/'+ date.getFullYear() +"</td>" +
                    "<td style='text-align:center'>"+ val.id +"</td>" +
                    "<td style='text-align:center'>"+ accounting.formatNumber(val.total_money, 0, ".", ",") +"</td>" +
                    "<td>"+ status +"</td>" +
                    "<td>"+ val.address +"</td>" +
                    "<td style='text-align:center'>" +
                    "<a href='#' id='"+ val.id +"' class='btn-view' onclick='viewOrderDetail(this);' data-toggle='modal' data-target='#order_detail_modal'>" +
                    "<i class='fa fa-file-text'></i></a></td></tr>");
            });

        }
    });
});

    function viewOrderDetail(btn){
        var id = $(btn).attr('id');
        console.log(id);
        $.ajax({
            type: "POST",
            url: "{{asset('user/order/get-order-detail')}}",
            data: {order_id: id},
            cache: false,
            success: function(data){
                $('#order_detail_table > tbody').html('');
                $.each(data, function(key, val){
                    var url_pro = "{{asset('product')}}/" + val.pro_id;
                    var url_img = "{{asset('upload/images')}}/" + val.image;
                    $('#order_detail_table > tbody').append("<tr>" +
                        "<td style='text-align: center'>"+ val.id +"</td>" +
                        "<td><a href='"+ url_pro +"' class='txt-link'>"+ val.pro_name +"</a></td>" +
                        "<td style='text-align:center'><img src='"+ url_img +"' style='width: 50px' /></td>" +
                        "<td style='text-align: center'><label class='box-color' style='background-color:"+ val.color +"'></label></td>" +
                        "<td style='text-align: center'>"+ val.size +"</td>" +
                        "<td style='text-align: center'>"+ accounting.formatNumber(val.price, 0, ".", ",") +" đ</td>" +
                        "<td style='text-align: center'>"+ val.qty +"</td>" +
                        "<td style='text-align: center'>"+ accounting.formatNumber(val.price*val.qty, 0, ".", ",") +" đ</td></tr>");
                });
            }
        });
    }

</script>
@stop